<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\TraitSettings;
use App\TransactionModel;
use App\SettingModel;
use App;
use DB;
use Auth;
class BudgetController extends Controller
{
	use TraitSettings;
	
	public function __construct() {
		$data = $this->getapplications();
		$lang = $data[0]->languages;
		App::setLocale($lang);
		$this->middleware( 'auth' );
	}
	//show default data
	public function index() {
		if (Auth::user()->isrole('6')){
			return view( 'budget.index' );
		} else{
			 return redirect('home');
		}
	}

	/**
	 * insert data to database
	 *
	 * @param string  $months
	 * @param string  $years
	 * @param double  $amount
	 * @param string  $category
	 * @return object
	 */
	public function save( Request $request ) {

		$months   = $request->input( 'months' );
		$years    = $request->input( 'years' );
		$amount   = $request->input( 'amount' );
		$category   = $request->input( 'subcategory' );
		if ( $months=='02' ) {
			$date    = $years.'-'.$months.'-28';
		}else {
			$date    = $years.'-'.$months.'-30';
		}
		$userid = Auth::id();
		$checkdata = DB::table( 'budget' )
		->whereMonth( 'fromdate', date( 'm', strtotime( $date ) ) )
		->whereYear( 'fromdate', date( 'Y', strtotime( $date ) ) )
		->where( 'categoryid', $category )
		->get();

		if ( count( $checkdata )==0 ) {
			$data = DB::table( 'budget' )
			->insert(
				[
				'userid'   =>$userid,
				'categoryid'  =>$category,
				'amount'   =>$amount,
				'fromdate'   =>$date
				]
			);
			$res['success'] = 'true';
			$res['message']= '1';
		}
		else {
			$res['message'] = '0';

		}
		return response( $res );
	}

	/**
	 * update data to database
	 *
	 * @param integer $id
	 * @param double  $amount
	 * @return object
	 */
	public function saveedit( Request $request ) {
		$id    = $request->input( 'id' );
		$amount   = $request->input( 'amount' );
		$userid = Auth::id();

		$data = DB::table( 'budget' )->where( 'budgetid', $id )
		->update(
			[
			'userid'   =>$userid,
			'amount'   =>$amount
			]
		);

		$res['success'] = 'true';
		$res['message']= '1';
		return response( $res );
	}

	/**
	 * get data from database
	 *
	 * @return object
	 */
	public function getdata() {
		$data = DB::table( 'budget' )
		->join( 'subcategory', 'subcategory.subcategoryid', '=', 'budget.categoryid' )
		->join( 'category', 'category.categoryid', '=', 'subcategory.categoryid' )
		->join( 'users', 'users.userid', '=', 'budget.userid' )
		->select( 'category.name as category', 'subcategory.name as subcategory', 'budget.*', 'users.name as user', 'budget.amount as originalamount' )
		->get();
		return Datatables::of( $data )
		->addColumn( 'amount', function( $single ) {
				$setting = DB::table( 'settings' )->where( 'settingsid', '1' )->get();
				return $setting[0]->currency.number_format( $single->amount, 2 );
			} )
		->addColumn( 'fromdate', function( $single ) {

				return date( "M Y", strtotime( $single->fromdate ) );
			} )
		->addColumn( 'action', function ( $accountsingle ) {
				return '<a href="#" id="btnedit" customdata='.$accountsingle->budgetid.' class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit"><i class="ti-pencil"></i> '. trans('lang.edit').'</a>
				<a href="#" id="btndelete" customdata='.$accountsingle->budgetid.' class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete"><i class="ti-trash"></i> '. trans('lang.delete').'</a>';

			} )->make( true );
	}

	/**
	 * get single data by date from database
	 *
	 * @param integer $id
	 * @param date    $date
	 * @return object
	 */
	public function gettransactionbydate( Request $request ) {
		$id   = $request->input( 'id' );
		$date   = $request->input( 'date' );

		$data = DB::table( 'transaction' )
		->selectRaw( 'sum(amount) as totalamount' )
		->where( 'categoryid', $id )
		->whereRaw( 'month(transactiondate)='.date( 'm', strtotime( $date ) ) )
		->whereRaw( 'year(transactiondate)='.date( 'Y', strtotime( $date ) ).' group by categoryid' )
		->get();

		$listdata = DB::table( 'transaction' )
		->selectRaw( '*' )
		->where( 'categoryid', $id )
		->whereRaw( 'month(transactiondate)='.date( 'm', strtotime( $date ) ) )
		->whereRaw( 'year(transactiondate)='.date( 'Y', strtotime( $date ) ) )
		->get();

		$setting = DB::table( 'settings' )->where( 'settingsid', '1' )->get();

		if ( count( $data )==0 ) {
			$res['amountcurrency']  = 0;
			$res['totalamount']  = 0;
		}else {
			$res['amountcurrency'] = $setting[0]->currency.number_format( $data[0]->totalamount, 2 );
			$res['totalamount'] = $data[0]->totalamount;
		}
		$res['currency'] = $setting[0]->currency;
		$res['listdata'] = $listdata;
		return response( $res );
	}

	/**
	 * delete data from database
	 *
	 * @param integer $id
	 * @return object
	 */
	public function deleteitem( Request $request ) {
		$id = $request->input( 'iddelete' );

		$delete = DB::table( 'budget' )->where( 'budgetid', $id )->delete();

		if ( $delete ) {
			$res['success'] = true;
			$res['message']= 'Budget has been deleted';
			return response( $res );
		}
	}

	/**
	 * get single data by id from database
	 *
	 * @param integer $id
	 * @return object
	 */
	public function budgetgetedit( Request $request ) {
		$id    = $request->input( 'id' );

		$data = DB::table( 'budget' )
		->join( 'subcategory', 'subcategory.subcategoryid', '=', 'budget.categoryid' )
		->join( 'category', 'category.categoryid', '=', 'subcategory.categoryid' )
		->select( 'category.name as category', 'category.categoryid as realcategoryid', 'subcategory.name as subcategory', 'budget.*', 'budget.amount as originalamount' )
		->where( 'budgetid', $id )
		->get();

		if ( $data ) {

			$res['success'] = true;
			$res['months'] = date( 'm', strtotime( $data[0]->fromdate ) );
			$res['years'] = date( 'Y', strtotime( $data[0]->fromdate ) );
			$res['message']= $data;
			return response( $res );
		}
	}

}

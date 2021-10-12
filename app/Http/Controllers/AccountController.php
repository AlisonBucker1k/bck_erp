<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\AccountModel;
use App\SettingModel;
use App\Http\Controllers\TraitSettings;
use DB;
use App;
use Auth;
class AccountController extends Controller
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
		if (Auth::user()->isrole('5')){
			return view( 'account.index' );
		} else{
			 return redirect('home');
		}
	}

	//show default data
	public function detail($id) {
		if (Auth::user()->isrole('5')){
			return view( 'account.detail',compact('id') );
		} else{
			 return redirect('home');
		}
	}

	/**
	 * Get account data
	 *
	 * @return object
	 */
	public function getdata() {
		$account = AccountModel::select( ['accountid', 'name', 'balance', 'description'] );

		return Datatables::of( $account )
		->addColumn( 'balance', function( $single ) {
				$setting = DB::table( 'settings' )->where( 'settingsid', '1' )->get();
				return $setting[0]->currency.number_format( $single->balance, 2 );
			} )
		->addColumn( 'action', function ( $accountsingle ) {
				return '<a href="account/detail/'.$accountsingle->accountid.'" id="btnedit" customdata='.$accountsingle->accountid.' class="btn btn-sm btn-success"><i class="ti-check-box"></i>'. trans('lang.detail').'</a>
						<a href="#" id="btnedit" customdata='.$accountsingle->accountid.' class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit"><i class="ti-pencil"></i> '. trans('lang.edit').'</a>
						<a href="#" id="btndelete" customdata='.$accountsingle->accountid.' class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete"><i class="ti-trash"></i> '. trans('lang.delete').'</a>';
			} )->make( true );
	}

	/**
	 * Get account data detail
	 *
	 * @return object
	 */
	public function getdatadetail($id){

		$data = DB::select("SELECT p.accountnumber, p.name,COALESCE(a.amount,0) as income,COALESCE(b.amount,0) as expense, COALESCE(p.balance+(COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance from account as p left join (select accountid,sum(amount) as amount from transaction where type=1 group by accountid) as a on a.accountid = p.accountid left join (select accountid,sum(amount) as amount from transaction where type=2 group by accountid) as b on b.accountid = p.accountid where p.accountid = $id group by p.accountid");
			
		$res['accountnumber'] = $data[0]->accountnumber;
		$res['name'] = $data[0]->name;
		$res['balance'] = number_format($data[0]->balance);
		return response($res);

	}

	/**
	 * Get account balance by month
	 *
	 * @return object
	 */
	public function accountbalancebymonth($id){
		
		$year = date('Y');
		$ijan 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=01 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=01 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$ifeb 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=02 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=02 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$imar 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=03 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=03 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$iapr 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=04 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=04 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$imay 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=05 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=05 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$ijun 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=06 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=06 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$ijul 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=07 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=07 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$iags 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=08 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=08 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$isep 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=09 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=09 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$iokt 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=10 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=10 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$inov 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=11 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=11 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$ides 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=12 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=12 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");

        $res['ijan'] = $ijan[0]->balance;
		$res['ifeb'] = $ifeb[0]->balance;
		$res['imar'] = $imar[0]->balance;
		$res['iapr'] = $iapr[0]->balance;
		$res['imay'] = $imay[0]->balance;
		$res['ijun'] = $ijun[0]->balance;
		$res['ijul'] = $ijul[0]->balance;
		$res['iags'] = $iags[0]->balance;
		$res['isep'] = $isep[0]->balance;
		$res['iokt'] = $iokt[0]->balance;
		$res['inov'] = $inov[0]->balance;
		$res['ides'] = $ides[0]->balance;
		

		return response($res);            

	}

	/**
	 * insert data to database
	 *
	 * @param string  $name
	 * @param double  $balance
	 * @param string  $description
	 * @param string  $accountnumber
	 * @return object
	 */
	public function save( Request $request ) {
		$name    = $request->input( 'name' );
		$balance   = $request->input( 'balance' );
		$description  = $request->input( 'description' );
		$accountnumber  = $request->input( 'accountnumber' );

		$data = array( 'name'=>$name, 'balance'=>$balance, 'description'=>$description,'accountnumber'=>$accountnumber );
		$insert = DB::table( 'account' )->insert( $data );

		if ( $insert ) {
			$res['success'] = true;
			$res['message']= 'Account has been added';
			return response( $res );
		}
	}

	/**
	 * update data to database
	 *
	 * @param int  	  $id
	 * @param string  $name
	 * @param double  $balance
	 * @param string  $description
	 * @param string  $accountnumber
	 * @return object
	 */
	public function saveedit( Request $request ) {
		$id    = $request->input( 'id' );
		$name    = $request->input( 'name' );
		$balance   = $request->input( 'balance' );
		$description  = $request->input( 'description' );
		$accountnumber  = $request->input( 'accountnumber' );

		$update = DB::table( 'account' )->where( 'accountid', $id )
		->update(
			[
			'name'   =>$name,
			'balance'  =>$balance,
			'description' =>$description,
			'accountnumber'=>$accountnumber
			]
		);

		if ( $update ) {
			$res['success'] = true;
			$res['message']= 'Account has been updated';
			return response( $res );
		}

	}

	/**
	 * delete data from database
	 *
	 * @param int  	  $id
	 * @return object
	 */
	public function delete( Request $request ) {
		$id = $request->input( 'iddelete' );

		$delete = DB::table( 'account' )->where( 'accountid', $id )->delete();
		$deletetransaction = DB::table( 'transaction' )->where( 'accountid', $id )->delete();
		if ( $delete ) {
			$res['success'] = true;
			$res['message']= 'Account has been deleted';
			return response( $res );
		}
	}

	/**
	 * get single data from database
	 *
	 * @param int  	  $id
	 * @return object
	 */
	public function getedit( Request $request ) {
		$id    = $request->input( 'id' );

		$data = DB::table( 'account' )->where( 'accountid', $id )->get();

		if ( $data ) {
			$res['success'] = true;
			$res['message']= $data;
			return response( $res );
		}
	}

	/**
	 * get account transaction
	 * 
	 * @return object
	 */

	public function getaccounttransaction($id){
		$data = DB::table('transaction')->select(['transaction.*', 'category.name as category', 'subcategory.name as subcategory',DB::raw("IFNULL(a.amount,'-') as income, IFNULL(b.amount,'-') as expense")])
		->leftJoin(DB::raw("(select transactionid,amount from transaction where type=1) as a"),function($join){
			$join->on("a.transactionid","=","transaction.transactionid");
		})
		->leftJoin(DB::raw("(select transactionid,amount from transaction where type=2) as b"),function($join){
			$join->on("b.transactionid","=","transaction.transactionid");
		})
		->leftJoin('subcategory','subcategoryid','=','transaction.categoryid')
		->leftJoin('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->leftJoin('account', 'account.accountid', '=', 'transaction.accountid')
		->where('transaction.accountid',"$id")
		->orderBy('transactiondate', 'desc');
			
		return Datatables::of($data)
		->addColumn('income',function($single){
			$setting = DB::table('settings')->where('settingsid','1')->get();
			$return = '';
			if($single->income =='-'){
				$return = '-';
			}else {
				
				$return = '<p class="text-success">'.$setting[0]->currency.number_format($single->income,2).'</p>';	
			}
			return $return;		
		})
		->addColumn('expense',function($single){
			$setting = DB::table('settings')->where('settingsid','1')->get();
			$return = '';
			if($single->expense =='-'){
				$return = '-';
			}else {
				
				$return = '<p class="text-danger">'.$setting[0]->currency.number_format($single->expense,2).'</p>';	
			}
			return $return;		
		})
		->addColumn('transactiondate',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return date($setting[0]->dateformat,strtotime($single->transactiondate));
		})
		->rawColumns(['expense', 'income'])
		->make(true);					
	}


}

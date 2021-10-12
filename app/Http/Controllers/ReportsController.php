<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\GoalModel;
use App\SettingModel;
use App\Http\Controllers\TraitSettings;
use DB;
use Auth;
use App;

class ReportsController extends Controller
{

	use TraitSettings;

	public function __construct() {
		$data = $this->getapplications();
		$lang = $data[0]->languages;
		App::setLocale($lang);
		$this->middleware( 'auth' );
	}

	//show default view
	public function incomereports() {
		if (Auth::user()->isrole('11')){
            return view( 'reports.income' );
        } else{
             return redirect('home');
        }
		
	}

	//show expense report view
	public function expensereports() {
		if (Auth::user()->isrole('12')){
            return view('reports.expense');
        } else{
             return redirect('home');
        }
		
	}
	//show income vs expense report view
	public function incomevsexpensereports() {
		if (Auth::user()->isrole('13')){
            return view('reports.incomevsexpense');
        } else{
             return redirect('home');
        }
	}

	//show account report view
	public function accountreports() {
		if (Auth::user()->isrole('16')){
           return view('reports.account');
        } else{
             return redirect('home');
        }
		
	}

	//show income month report view
	public function incomemonth(){
		if (Auth::user()->isrole('14')){
           return view('reports.incomemonth');
        } else{
             return redirect('home');
        }
		
	}

	//show expense month report view
	public function expensemonth(){
		if (Auth::user()->isrole('15')){
           return view('reports.expensemonth');
        } else{
             return redirect('home');
        }
		
	}

	//show upcoming income  report view
	public function upcomingincomereports(){
		if (Auth::user()->isrole('19')){
           return view('reports.upcomingincome');
        } else{
             return redirect('home');
        }
		
	}

	//show upcoming expense  report view
	public function upcomingexpensereports(){
		if (Auth::user()->isrole('20')){
           return view('reports.upcomingexpense');
        } else{
             return redirect('home');
        }
		
	}

	//show all report report view
	public function allreports(){
		return view('reports.reports');
	}

	/**
	 * get data income/expense from database
	 *
	 * @param string  $type
	 * @return object
	 */
	public function gettransactions(Request $request){
		$type = $request->input('type');

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->join('account', 'account.accountid', '=', 'transaction.accountid')
		->select(['category.name as category', 'category.categoryid as categoryid1', 'subcategory.subcategoryid as subcategoryid2', 'subcategory.name as subcategory', 'transaction.*', 'users.name as user','account.name as account'])
		->where('transaction.type',$type);


		return Datatables::of($data)
		->addColumn('amount',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->amount,2);
			})
		->addColumn('transactiondate',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return date($setting[0]->dateformat,strtotime($single->transactiondate));
			})
		->filter(function ($query) use ($request) {
				if ($request->has('names')) {
					$query->where('transaction.name', 'like', "%{$request->get('names')}%");
				}
				if ($request->has('category')) {
					$query->where('category.categoryid', 'like', "%{$request->get('category')}%");
				}
				if ($request->has('subcategory')) {
					$query->where('subcategory.subcategoryid', 'like', "%{$request->get('subcategory')}%");
				}
				if ($request->has('fromdate') && $request->has('todate')) {
					$query->whereBetween('transaction.transactiondate', [$request->get('fromdate'), $request->get('todate')]);
				}

			})
		->make(true);


	}


	/**
	 * get data income/expense from database
	 *
	 * @param string  $type
	 * @return object
	 */
	public function gettransactionsupcoming(Request $request){
		$type = $request->input('type');

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->select(['category.name as category', 'category.categoryid as categoryid1', 'subcategory.subcategoryid as subcategoryid2', 'subcategory.name as subcategory', 'transaction.*', 'users.name as user'])
		->where('transaction.type',$type);


		return Datatables::of($data)
		->addColumn('amount',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->amount,2);
			})
		->addColumn('transactiondate',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return date($setting[0]->dateformat,strtotime($single->transactiondate));
			})
		->filter(function ($query) use ($request) {
				if ($request->has('names')) {
					$query->where('transaction.name', 'like', "%{$request->get('names')}%");
				}
				if ($request->has('category')) {
					$query->where('category.categoryid', 'like', "%{$request->get('category')}%");
				}
				if ($request->has('subcategory')) {
					$query->where('subcategory.subcategoryid', 'like', "%{$request->get('subcategory')}%");
				}
				if ($request->has('fromdate') && $request->has('todate')) {
					$query->whereBetween('transaction.transactiondate', [$request->get('fromdate'), $request->get('todate')]);
				}

			})
		->make(true);


	}



	/**
	 * get data account transaction from database
	 *
	 * @param string  $account
	 * @param date    $fromdate
	 * @param date    $todate
	 * @return object
	 */
	public function getaccounttransaction(Request $request){
		$data = DB::table('transaction')->select(['transaction.*', 'category.name as category', 'subcategory.name as subcategory',DB::raw("IFNULL(a.amount,'-') as income, IFNULL(b.amount,'-') as expense")])
		->leftJoin(DB::raw("(select transactionid,amount from transaction where type=1) as a"),function($join){
				$join->on("a.transactionid","=","transaction.transactionid");
			})
		->leftJoin(DB::raw("(select transactionid,amount from transaction where type=2) as b"),function($join){
				$join->on("b.transactionid","=","transaction.transactionid");
			})
		->leftJoin('subcategory','subcategoryid','=','transaction.categoryid')
		->leftJoin('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->leftJoin('account', 'account.accountid', '=', 'transaction.accountid');

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
		->filter(function ($query) use ($request) {
				if ($request->has('names')) {
					$query->where('transaction.name', 'like', "%{$request->get('names')}%");
				}
				if ($request->has('account')) {
					$query->where('transaction.accountid', 'like', "%{$request->get('account')}%");
				}
				if ($request->has('fromdate') && $request->has('todate')) {
					$query->whereBetween('transaction.transactiondate', [$request->get('fromdate'), $request->get('todate')]);
				}


			})
		->rawColumns(['expense', 'income'])
		->make(true);
	}


	/**
	 * get remaining balance from database
	 *
	 * @return object
	 */
	public function getbalance(){

		$yearincome   = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalyear'))
		->where('type', '=', '1')
		->whereYear('transactiondate',date('Y'))
		->get();

		$yearexpense   = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalyear'))
		->where('type', '=', '2')
		->whereYear('transactiondate',date('Y'))
		->get();

		$yearbalance   = $yearincome[0]->totalyear - $yearexpense[0]->totalyear;

		$res['year']  = number_format($yearbalance,2);

		return response($res);

	}

	/**
	 * get monthly income reports
	 *
	 * @return object
	 */
	public function getincomemonthly(){
		$data = DB::select("SELECT  category.name AS category, transaction.type AS type,
							SUM( IF( MONTH(transactiondate) = 1, amount, 0) ) AS ijan,
							COUNT( IF( MONTH(transactiondate) = 1, amount, NULL) ) AS trx_1,
							SUM( IF( MONTH(transactiondate) = 2, amount, 0) ) AS ifeb,
							COUNT( IF( MONTH(transactiondate) = 2, amount, NULL) ) AS trx_2,
							SUM( IF( MONTH(transactiondate) = 3, amount, 0) ) AS imar,
							COUNT( IF( MONTH(transactiondate) = 3, amount, NULL) ) AS trx_3,
							SUM( IF( MONTH(transactiondate) = 4, amount, 0) ) AS iapr,
							COUNT( IF( MONTH(transactiondate) = 4, amount, NULL) ) AS trx_4,
							SUM( IF( MONTH(transactiondate) = 5, amount, 0) ) AS imay,
							COUNT( IF( MONTH(transactiondate) = 5, amount, NULL) ) AS trx_5,
							SUM( IF( MONTH(transactiondate) = 6, amount, 0) ) AS ijun,
							COUNT( IF( MONTH(transactiondate) = 6, amount, NULL) ) AS trx_6,
							SUM( IF( MONTH(transactiondate) = 7, amount, 0) ) AS ijul,
							COUNT( IF( MONTH(transactiondate) = 7, amount, NULL) ) AS trx_7,
							SUM( IF( MONTH(transactiondate) = 8, amount, 0) ) AS iags,
							COUNT( IF( MONTH(transactiondate) = 8, amount, NULL) ) AS trx_8,
							SUM( IF( MONTH(transactiondate) = 9, amount, 0) ) AS isep,
							COUNT( IF( MONTH(transactiondate) = 9, amount, NULL) ) AS trx_9,
							SUM( IF( MONTH(transactiondate) = 10, amount, 0) ) AS iokt,
							COUNT( IF( MONTH(transactiondate) = 10, amount, NULL) ) AS trx_10,
							SUM( IF( MONTH(transactiondate) = 11, amount, 0) ) AS inov,
							COUNT( IF( MONTH(transactiondate) = 11, amount, NULL) ) AS trx_11,
							SUM( IF( MONTH(transactiondate) = 12, amount, 0) ) AS idec,
							COUNT( IF( MONTH(transactiondate) = 12, amount, NULL) ) AS trx_12,
							COUNT(transactionid) AS jml_trx,
							SUM( amount ) AS total
							FROM transaction left join subcategory on transaction.categoryid = subcategory.subcategoryid
										left join category on category.categoryid = subcategory.categoryid where transaction.type = 1 and year(transaction.transactiondate) =".date('Y')."
							GROUP BY transaction.type, category.name
							ORDER BY SUM( amount ) DESC, transaction.type");

		return Datatables::of($data)
		->addColumn('ijan',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->ijan,2);
			})
		->addColumn('ifeb',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->ifeb,2);
			})
		->addColumn('imar',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->imar,2);
			})
		->addColumn('iapr',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->iapr,2);
			})
		->addColumn('imay',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->imay,2);
			})
		->addColumn('ijun',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->ijun,2);
			})
		->addColumn('ijul',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->ijul,2);
			})
		->addColumn('iags',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->iags,2);
			})
		->addColumn('isep',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->isep,2);
			})
		->addColumn('iokt',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->iokt,2);
			})
		->addColumn('inov',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->inov,2);
			})
		->addColumn('idec',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->idec,2);
			})
		->addColumn('total',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->total,2);
			})

		->make(true);
	}

	/**
	 * get monthly expense reports
	 *
	 * @return object
	 */
	public function getexpensemonthly(){
		$data = DB::select("SELECT  category.name AS category, transaction.type AS type,
							SUM( IF( MONTH(transactiondate) = 1, amount, 0) ) AS ijan,
							COUNT( IF( MONTH(transactiondate) = 1, amount, NULL) ) AS trx_1,
							SUM( IF( MONTH(transactiondate) = 2, amount, 0) ) AS ifeb,
							COUNT( IF( MONTH(transactiondate) = 2, amount, NULL) ) AS trx_2,
							SUM( IF( MONTH(transactiondate) = 3, amount, 0) ) AS imar,
							COUNT( IF( MONTH(transactiondate) = 3, amount, NULL) ) AS trx_3,
							SUM( IF( MONTH(transactiondate) = 4, amount, 0) ) AS iapr,
							COUNT( IF( MONTH(transactiondate) = 4, amount, NULL) ) AS trx_4,
							SUM( IF( MONTH(transactiondate) = 5, amount, 0) ) AS imay,
							COUNT( IF( MONTH(transactiondate) = 5, amount, NULL) ) AS trx_5,
							SUM( IF( MONTH(transactiondate) = 6, amount, 0) ) AS ijun,
							COUNT( IF( MONTH(transactiondate) = 6, amount, NULL) ) AS trx_6,
							SUM( IF( MONTH(transactiondate) = 7, amount, 0) ) AS ijul,
							COUNT( IF( MONTH(transactiondate) = 7, amount, NULL) ) AS trx_7,
							SUM( IF( MONTH(transactiondate) = 8, amount, 0) ) AS iags,
							COUNT( IF( MONTH(transactiondate) = 8, amount, NULL) ) AS trx_8,
							SUM( IF( MONTH(transactiondate) = 9, amount, 0) ) AS isep,
							COUNT( IF( MONTH(transactiondate) = 9, amount, NULL) ) AS trx_9,
							SUM( IF( MONTH(transactiondate) = 10, amount, 0) ) AS iokt,
							COUNT( IF( MONTH(transactiondate) = 10, amount, NULL) ) AS trx_10,
							SUM( IF( MONTH(transactiondate) = 11, amount, 0) ) AS inov,
							COUNT( IF( MONTH(transactiondate) = 11, amount, NULL) ) AS trx_11,
							SUM( IF( MONTH(transactiondate) = 12, amount, 0) ) AS idec,
							COUNT( IF( MONTH(transactiondate) = 12, amount, NULL) ) AS trx_12,
							COUNT(transactionid) AS jml_trx,
							SUM( amount ) AS total
							FROM transaction left join subcategory on transaction.categoryid = subcategory.subcategoryid
										left join category on category.categoryid = subcategory.categoryid where transaction.type = 2 and year(transaction.transactiondate) =".date('Y')."
							GROUP BY transaction.type, category.name
							ORDER BY SUM( amount ) DESC, transaction.type");

		return Datatables::of($data)
		->addColumn('ijan',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->ijan,2);
			})
		->addColumn('ifeb',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->ifeb,2);
			})
		->addColumn('imar',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->imar,2);
			})
		->addColumn('iapr',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->iapr,2);
			})
		->addColumn('imay',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->imay,2);
			})
		->addColumn('ijun',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->ijun,2);
			})
		->addColumn('ijul',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->ijul,2);
			})
		->addColumn('iags',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->iags,2);
			})
		->addColumn('isep',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->isep,2);
			})
		->addColumn('iokt',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->iokt,2);
			})
		->addColumn('inov',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->inov,2);
			})
		->addColumn('idec',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->idec,2);
			})
		->addColumn('total',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->total,2);
			})

		->make(true);
	}


}

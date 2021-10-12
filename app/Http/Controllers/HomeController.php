<?php

namespace App\Http\Controllers;
use App\TransactionModel;
use App\SettingModel;
use App\UserModel;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\TraitSettings;
use App;
use DB;
use Auth;

class HomeController extends Controller
{
	
	use TraitSettings;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$data = $this->getapplications();
		$lang = $data[0]->languages;
		App::setLocale($lang);
		$this->middleware( 'auth' );
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view( 'dashboard.index' );
	}

	/**
	 * Show income vs expense by month.
	 *
	 * @return object
	 */

	public function incomevsexpense() {

		$thisyear= date("Y");

		$ijan   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '01')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$ifeb   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '02')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$imar   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '03')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$iapr   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '04')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$imay   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '05')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$ijun   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '06')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$ijul   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '07')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$iags   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '08')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$isep   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '09')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$iokt   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '10')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$inov   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '11')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$ides   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '12')
		->whereYear('transactiondate', '=', $thisyear)
		->get();


		//upcoming income
		$uijan   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '01')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$uifeb   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '02')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$uimar   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '03')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$uiapr   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '04')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$uimay   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '05')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$uijun   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '06')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$uijul   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '07')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$uiags   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '08')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$uisep   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '09')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$uiokt   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '10')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$uinov   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '11')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$uides   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '12')
		->whereYear('transactiondate', '=', $thisyear)
		->get();

		//expense
		$ejan   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '01')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$efeb   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '02')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$emar   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '03')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$eapr   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '04')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$emay   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '05')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$ejun   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '06')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$ejul   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '07')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$eags   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '08')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$esep   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '09')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$eokt   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '10')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$enov   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '11')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$edes   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '12')
		->whereYear('transactiondate', '=', $thisyear)
		->get();


		//upcoming expense
		$iejan   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '01')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$iefeb   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '02')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$iemar   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '03')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$ieapr   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '04')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$iemay   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '05')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$iejun   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '06')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$iejul   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '07')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$ieags   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '08')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$iesep   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '09')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$ieokt   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '10')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$ienov   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '11')
		->whereYear('transactiondate', '=', $thisyear)
		->get();
		$iedes   = DB::table('transaction')
		->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '12')
		->whereYear('transactiondate', '=', $thisyear)
		->get();


		$res['ijan'] = $ijan[0]->amount;
		$res['ifeb'] = $ifeb[0]->amount;
		$res['imar'] = $imar[0]->amount;
		$res['iapr'] = $iapr[0]->amount;
		$res['imay'] = $imay[0]->amount;
		$res['ijun'] = $ijun[0]->amount;
		$res['ijul'] = $ijul[0]->amount;
		$res['iags'] = $iags[0]->amount;
		$res['isep'] = $isep[0]->amount;
		$res['iokt'] = $iokt[0]->amount;
		$res['inov'] = $inov[0]->amount;
		$res['ides'] = $ides[0]->amount;


		$res['uijan'] = $uijan[0]->amount;
		$res['uifeb'] = $uifeb[0]->amount;
		$res['uimar'] = $uimar[0]->amount;
		$res['uiapr'] = $uiapr[0]->amount;
		$res['uimay'] = $uimay[0]->amount;
		$res['uijun'] = $uijun[0]->amount;
		$res['uijul'] = $uijul[0]->amount;
		$res['uiags'] = $uiags[0]->amount;
		$res['uisep'] = $uisep[0]->amount;
		$res['uiokt'] = $uiokt[0]->amount;
		$res['uinov'] = $uinov[0]->amount;
		$res['uides'] = $uides[0]->amount;



		$res['ejan'] = $ejan[0]->amount;
		$res['efeb'] = $efeb[0]->amount;
		$res['emar'] = $emar[0]->amount;
		$res['eapr'] = $eapr[0]->amount;
		$res['emay'] = $emay[0]->amount;
		$res['ejun'] = $ejun[0]->amount;
		$res['ejul'] = $ejul[0]->amount;
		$res['eags'] = $eags[0]->amount;
		$res['esep'] = $esep[0]->amount;
		$res['eokt'] = $eokt[0]->amount;
		$res['enov'] = $enov[0]->amount;
		$res['edes'] = $edes[0]->amount;


		$res['iejan'] = $iejan[0]->amount;
		$res['iefeb'] = $iefeb[0]->amount;
		$res['iemar'] = $iemar[0]->amount;
		$res['ieapr'] = $ieapr[0]->amount;
		$res['iemay'] = $iemay[0]->amount;
		$res['iejun'] = $iejun[0]->amount;
		$res['iejul'] = $iejul[0]->amount;
		$res['ieags'] = $ieags[0]->amount;
		$res['iesep'] = $iesep[0]->amount;
		$res['ieokt'] = $ieokt[0]->amount;
		$res['ienov'] = $ienov[0]->amount;
		$res['iedes'] = $iedes[0]->amount;

		return response($res);
	}

	/**
	 * Show expense by category monthly.
	 *
	 * @return object
	 */
	public function expensebycategory() {

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->select(DB::raw('sum(amount) as amount, category.name as category, category.color as color'))
		->where('category.type', '2')
		->where('transaction.type', '2')
		->whereMonth('transactiondate', '=', date("m"))
		->groupBy('category.categoryid')
		->groupBy('category.name')
		->groupBy('category.color')
		->get();
		return response($data);
	}

	/**
	 * Show upcoming expense by category monthly.
	 *
	 * @return object
	 */
	public function upcomingexpensebycategory() {

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->select(DB::raw('sum(amount) as amount, category.name as category, category.color as color'))
		->where('category.type', '2')
		->where('transaction.type', '4')
		->whereMonth('transactiondate', '=', date("m"))
		->groupBy('category.categoryid')
		->groupBy('category.name')
		->groupBy('category.color')
		->get();
		return response($data);
	}

	/**
	 * Show expense by category yearly.
	 *
	 * @return object
	 */
	public function expensebycategoryyearly() {

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->select(DB::raw('sum(amount) as amount, category.name as category, category.color as color'))
		->where('category.type', '2')
		->where('transaction.type', '2')
		->whereYear('transactiondate', '=', date("Y"))
		->groupBy('category.categoryid')
		->groupBy('category.name')
		->groupBy('category.color')
		->get();
		return response($data);
	}


	/**
	 * Show expense by category yearly.
	 *
	 * @return object
	 */
	public function upcomingexpensebycategoryyearly() {

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->select(DB::raw('sum(amount) as amount, category.name as category, category.color as color'))
		->where('category.type', '2')
		->where('transaction.type', '4')
		->whereYear('transactiondate', '=', date("Y"))
		->groupBy('category.categoryid')
		->groupBy('category.name')
		->groupBy('category.color')
		->get();
		return response($data);
	}


	/**
	 * Show income by category monthly.
	 *
	 * @return object
	 */
	public function incomebycategory() {

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->select(DB::raw('sum(amount) as amount, category.name as category, category.color as color'))
		->where('category.type', '1')
		->where('transaction.type', '1')
		->whereMonth('transactiondate', '=', date("m"))
		->groupBy('category.categoryid')
		->groupBy('category.name')
		->groupBy('category.color')
		->get();
		return response($data);
	}

	/**
	 * Show income by category yearly.
	 *
	 * @return object
	 */
	public function incomebycategoryyearly() {

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->select(DB::raw('sum(amount) as amount, category.name as category, category.color as color'))
		->where('category.type', '1')
		->where('transaction.type', '1')
		->whereYear('transactiondate', '=', date("Y"))
		->groupBy('category.categoryid')
		->groupBy('category.name')
		->groupBy('category.color')
		->get();
		return response($data);
	}


	/**
	 * Show upcoming income by category yearly.
	 *
	 * @return object
	 */
	public function upcomingincomebycategoryyearly() {

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->select(DB::raw('sum(amount) as amount, category.name as category, category.color as color'))
		->where('category.type', '1')
		->where('transaction.type', '3')
		->whereYear('transactiondate', '=', date("Y"))
		->groupBy('category.categoryid')
		->groupBy('category.name')
		->groupBy('category.color')
		->get();
		return response($data);
	}

	/**
	 * Show total balance.
	 *
	 * @return object
	 */
	public function totalbalance() {
		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->select(DB::raw('sum(amount) as amount, category.name as category, category.color as color'))
		->where('category.type', '2')
		->whereMonth('transactiondate', '=', date("m"))
		->groupBy('transaction.categoryid')
		->groupBy('category.name')
		->groupBy('category.color')
		->get();
		return response($data);
	}

	/**
	 * Show account balance.
	 *
	 * @return object
	 */
	public function accountbalance(){

		$data = DB::select("SELECT p.name,COALESCE(a.amount,0) as income,COALESCE(b.amount,0) as expense, COALESCE(p.balance+(COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance from account as p left join (select accountid,sum(amount) as amount from transaction where type=1 and year(transactiondate)=".date('Y')." group by accountid) as a on a.accountid = p.accountid left join (select accountid,sum(amount) as amount from transaction where type=2 and year(transactiondate)=".date('Y')." group by accountid) as b on b.accountid = p.accountid group by p.accountid");
		return response($data);
	}

	/**
	 * Show budget list.
	 *
	 * @return object
	 */

	public function budgetlist(){
		$data = DB::table('budget')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'budget.categoryid')
		->join('category', 'subcategory.categoryid', '=', 'category.categoryid')
		->whereMonth('budget.fromdate', '=', date("m"))
		->groupBy('budget.categoryid')
		->get();

		return response($data);
	}

	/**
	 * Show latest 10 income from database
	 *
	 * @return object
	 */
	public function latestincome(){
		$data  = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->join('account', 'account.accountid', '=', 'transaction.accountid')
		->select('category.name as category', 'subcategory.name as subcategory', 'transaction.*','users.name as user','account.name as account')
		->where('transaction.type','1')
		->offset(0)->limit(10)
		->orderBy('transactiondate', 'desc')
		->get();

		return Datatables::of($data)
		->addColumn('amount',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->amount,2);
			})
		->addColumn('transactiondate',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return date($setting[0]->dateformat,strtotime($single->transactiondate));
			})
		->make(true);

	}

	/**
	 * Show latest 10 expense from database
	 *
	 * @return object
	 */
	public function latestexpense(){
		$data  = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->join('account', 'account.accountid', '=', 'transaction.accountid')
		->select('category.name as category','subcategory.name as subcategory', 'transaction.*','users.name as user','account.name as account')
		->where('transaction.type','2')
		->offset(0)->limit(10)
		->orderBy('transactiondate', 'desc')
		->get();

		return Datatables::of($data)
		->addColumn('amount',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->amount,2);
			})
		->addColumn('transactiondate',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return date($setting[0]->dateformat,strtotime($single->transactiondate));
			})
		->make(true);

	}
}

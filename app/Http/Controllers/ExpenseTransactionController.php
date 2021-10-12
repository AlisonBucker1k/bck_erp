<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\TraitSettings;
use App\TransactionModel;
use App\SettingModel;
use App\SubCategoryModel;
use App\AccountModel;
use DB;
use App;
use Auth;

class ExpenseTransactionController extends Controller
{

	use TraitSettings;

	public function __construct()
    {
    	$data = $this->getapplications();
		$lang = $data[0]->languages;
		App::setLocale($lang);
        $this->middleware('auth');
    }
	
    //show default data
    public function index(){
    	if (Auth::user()->isrole('4')){
			return view( 'transaction.index' );
		} else{
			 return redirect('home');
		}
    }
	
	//show dashboard view
	public function dashboard(){
    	if (Auth::user()->isrole('4')){
			return view( 'expense.index' );
		} else{
			 return redirect('home');
		}
    }


    //show default dashboard view
	public function upcomingexpense() {
		if (Auth::user()->isrole('20')){
			return view('expense.upcomingexpense');
		} else{
			 return redirect('home');
		}
		
	}

	
	/**
	 * get count sum transaction
	 * @return object
	 */
	public function total(){
		$totalbalance = DB::table('transaction')
                     ->select(DB::raw('sum(amount) as totalbalance'))
                     ->where('type', '=', '2')
                     ->get();
		
		$year 		= DB::table('transaction')
                     ->select(DB::raw('sum(amount) as totalyear'))
                     ->where('type', '=', '2')
					 ->whereYear('transactiondate',date('Y'))
                     ->get();	
					 
		$month 		= DB::table('transaction')
                     ->select(DB::raw('sum(amount) as totalmonth'))
                     ->where('type', '=', '2')
					 ->whereMonth('transactiondate', '=', date('m'))
                     ->get();
					 
		$week 		= DB::table('transaction')
                     ->select(DB::raw('sum(amount) as totalweek'))
                     ->whereRaw('type = 2')
					 ->whereRaw('YEARWEEK(curdate()) = YEARWEEK(transactiondate)')
                     ->get();			 
					 
		$day 		= DB::table('transaction')
                     ->select(DB::raw('sum(amount) as totalday'))
                     ->where('type', '=', '2')
					 ->whereDate('transactiondate',date('Y-m-d'))
                     ->get();
					 
		$res['totalbalance'] 	= number_format($totalbalance[0]->totalbalance,2);
		$res['year'] 			= number_format($year[0]->totalyear,2);
		$res['month'] 			= number_format($month[0]->totalmonth,2);
		$res['week'] 			= number_format($week[0]->totalweek,2);
		$res['day'] 			= number_format($day[0]->totalday,2);

		
		return response($res);
	}

	/**
	 * Show upcomingtotal transaction by year, month,week and day
	 *
	 * @return object
	 */
	public function totalupcoming() {
		$totalbalance = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalbalance'))
		->where('type', '=', '4')
		->get();

		$year   = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalyear'))
		->where('type', '=', '4')
		->whereYear('transactiondate', date('Y'))
		->get();

		$month   = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalmonth'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', date('m'))
		->get();

		$week 	= DB::table('transaction')
                ->select(DB::raw('sum(amount) as totalweek'))
                ->whereRaw('type = 4')
				->whereRaw('YEARWEEK(curdate()) = YEARWEEK(transactiondate)')
                ->get();

		$day   = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalday'))
		->where('type', '=', '4')
		->whereDate('transactiondate', date('Y-m-d'))
		->get();

		$res['totalbalance']  = number_format($totalbalance[0]->totalbalance,2);
		$res['year']    = number_format($year[0]->totalyear,2);
		$res['month']    = number_format($month[0]->totalmonth,2);
		$res['week']    = number_format($week[0]->totalweek,2);
		$res['day']    = number_format($day[0]->totalday,2);


		return response($res);
	}

	
	
	/**
	 * get  transaction data for calendar
	 * @return object
	 */
	public function getdatacalendar(){
	
		$data = DB::table('transaction')
		->where('transaction.type','2')
		->select('name as title','transactiondate as start','amount')
		->get();
		
		return response($data);
	}
	
	/**
	 * get  expense transaction data from database
	 * @return object
	 */
	public function getdata(){
		$data = DB::table('transaction')
            ->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
			->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
			->join('users', 'users.userid', '=', 'transaction.userid')
			->join('account', 'account.accountid', '=', 'transaction.accountid')
            ->select('category.name as category','subcategory.name as subcategory', 'transaction.*','users.name as user','account.name as account')
			->where('transaction.type','2')
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
		->addColumn('action', function ($accountsingle) {
			$path = '../upload/expense/';
			if($accountsingle->file!=''){
                return '<a href='.$path.$accountsingle->file.' id="btndownload" class="btn btn-sm btn-warning" download><i class="ti-download"></i> '. trans('lang.receipt').'</a>
				<a href="#" id="btnedit" customdata='.$accountsingle->transactionid.' class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit"><i class="ti-pencil"></i> '. trans('lang.edit').'</a>
				<a href="#" id="btndelete" customdata='.$accountsingle->transactionid.' class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete"><i class="ti-trash"></i> '. trans('lang.delete').'</a>';
			}else{
				 return '<a href="#" id="btnedit" customdata='.$accountsingle->transactionid.' class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit"><i class="ti-pencil"></i> '. trans('lang.edit').'</a>
				<a href="#" id="btndelete" customdata='.$accountsingle->transactionid.' class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete"><i class="ti-trash"></i> '. trans('lang.delete').'</a>';
			
			}
            })->make(true);
	}
	


	/**
	 * get upcoming income from database
	 *
	 * @return object
	 */
	public function getdataupcoming(){
		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->select('category.name as category','subcategory.name as subcategory', 'transaction.*','users.name as user')
		->where('transaction.type','4')
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
		->addColumn('action', function ($accountsingle) {
				$path = '../upload/income/';
				if($accountsingle->file!=''){
					return '<a href="#" id="btnpay" customdata='.$accountsingle->transactionid.' class="btn btn-sm btn-info" data-toggle="modal" data-target="#pay"><i class="ti-wallet"></i>'. trans('lang.pay_bill').'</a>
					<a href='.$path.$accountsingle->file.' id="btndownload" class="btn btn-sm btn-warning" download><i class="ti-download"></i> '. trans('lang.receipt').'</a>
				<a href="#" id="btnedit" customdata='.$accountsingle->transactionid.' class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit"><i class="ti-pencil"></i> '. trans('lang.edit').'</a>
				<a href="#" id="btndelete" customdata='.$accountsingle->transactionid.' class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete"><i class="ti-trash"></i> '. trans('lang.delete').'</a>';
				}else{
					return '<a href="#" id="btnpay" customdata='.$accountsingle->transactionid.' class="btn btn-sm btn-info" data-toggle="modal" data-target="#pay"><i class="ti-wallet"></i> '. trans('lang.pay_bill').'</a>
					<a href="#" id="btnedit" customdata='.$accountsingle->transactionid.' class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit"><i class="ti-pencil"></i> '. trans('lang.edit').'</a>
				<a href="#" id="btndelete" customdata='.$accountsingle->transactionid.' class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete"><i class="ti-trash"></i> '. trans('lang.delete').'</a>';

				}
			})->make(true);
	}


	/**
	 * insert data Upcoming income to database
	 *
	 * @param string  $incomename
	 * @param double  $incomeamount
	 * @param string  $incomereference
	 * @param string  $incomeaccount
	 * @param string  $incomecategory
	 * @param string  $incomesubcategory
	 * @param string  $incomenote
	 * @param date    $incomedate
	 * @param string  $incomefile
	 * @return object
	 */
	public function saveupcoming(Request $request){
		$incomename    = $request->input('incomename');
		$incomeamount    = $request->input('incomeamount');
		$incomereference   = $request->input('incomereference');
		$incomeaccount    = '0';
		$incomecategory   = $request->input('incomecategory');
		$incomesubcategory   = $request->input('incomesubcategory');
		$incomenote    = $request->input('incomenote');
		$incomedate    = $request->input('incomedate');
		$incomefile    = $request->file('incomefile');
		$userid = Auth::user()->userid;
		//enabled extension=php_fileinfo.dll for mimes
		$message = ['incomefile.mimes'=>trans('lang.upload_transaction')];

		
		if($request->hasFile('incomefile')) {
			$this->validate($request, [
				'incomefile' => 'image|mimes:jpeg,png,jpg,pdf|max:2048'
				],$message);

			$incomefilename  = $request->file('incomefile')->getClientOriginalName();
			$request->file('incomefile')->move(public_path("/upload/income"), $incomefilename);
			$data = DB::table('transaction')
			->insert(
				[
				'userid'   =>$userid,
				'categoryid'  =>$incomesubcategory,
				'accountid'   =>$incomeaccount,
				'name'    =>$incomename,
				'amount'   =>$incomeamount,
				'reference'   =>$incomereference,
				'transactiondate' =>$incomedate,
				'type'    =>'4',
				'description'  =>$incomenote,
				'file'    =>$incomefilename
				]
			);
		} else{
			$data = DB::table('transaction')
			->insert(
				[
				'userid'   =>$userid,
				'categoryid'  =>$incomesubcategory,
				'accountid'   =>$incomeaccount,
				'name'    =>$incomename,
				'amount'   =>$incomeamount,
				'reference'   =>$incomereference,
				'transactiondate' =>$incomedate,
				'type'    =>'4',
				'description'  =>$incomenote
				]
			);

		}

		if($data){
			$res['success'] = true;
			$res['message']= 'Income has been added';
			return response($res);
		}
	}




	/**
	 * insert data expense to database
	 *
	 * @param string  $expensename
	 * @param double  $expenseamount
	 * @param string  $expensereference
	 * @param string  $expenseaccount
	 * @param string  $expensecategory
	 * @param string  $expensesubcategory
	 * @param string  $expensenote
	 * @param date    $expensedate
	 * @param string  $expensefile
	 * @return object
	 */
    public function saveexpense(Request $request){
    	$expensename 			= $request->input('expensename');
		$expenseamount 			= $request->input('expenseamount');
		$expensereference 		= $request->input('expensereference');
		$expenseaccount 		= $request->input('expenseaccount');
		$expensecategory 		= $request->input('expensecategory');
		$expensesubcategory 	= $request->input('expensesubcategory');
		$expensenote 			= $request->input('expensenote');
		$expensedate 			= $request->input('expensedate');
		$expensefile 			= $request->file('expensefile');
		$userid = Auth::user()->userid;
		$message = ['expensefile.mimes'=>trans('lang.upload_transaction')];
		
		
		if($request->hasFile('expensefile')) {
			$this->validate($request, [
            'expensefile' => 'image|mimes:jpeg,png,jpg,pdf|max:2048'
			],$message);
		
			$expensefilename 	= $request->file('expensefile')->getClientOriginalName();
			$request->file('expensefile')->move(public_path("/upload/expense"), $expensefilename);
			$data = DB::table('transaction')
			->insert(
				[
				'userid'			=>$userid,
				'categoryid'		=>$expensesubcategory,
				'accountid'			=>$expenseaccount,
				'name'				=>$expensename,
				'amount'			=>$expenseamount,
				'reference'			=>$expensereference,
				'transactiondate'	=>$expensedate,
				'type'				=>'2',
				'description'		=>$expensenote,
				'file'				=>$expensefilename
				]
			);
		} else{
			$data = DB::table('transaction')
			->insert(
				[
				'userid'			=>$userid,
				'categoryid'		=>$expensesubcategory,
				'accountid'			=>$expenseaccount,
				'name'				=>$expensename,
				'amount'			=>$expenseamount,
				'reference'			=>$expensereference,
				'transactiondate'	=>$expensedate,
				'type'				=>'2',
				'description'		=>$expensenote,
				]
			);
		
		}
		
		if($data){
				$res['success'] = true;
				$res['message']= 'Expense has been added';
				return response($res);
		}
    }
	
	/**
	 * update data  expense to database
	 * @param integer  $id
	 * @param string  $expensename
	 * @param double  $expenseamount
	 * @param string  $expensereference
	 * @param string  $expenseaccount
	 * @param string  $expensecategory
	 * @param string  $expensesubcategory
	 * @param string  $expensenote
	 * @param date    $expensedate
	 * @param string  $expensefile
	 * @return object
	 */
    public function saveedit(Request $request){
		$id 					= $request->input('id');
		$expensename 			= $request->input('expensename');
		$expenseamount 			= $request->input('expenseamount');
		$expensereference 		= $request->input('expensereference');
		$expenseaccount 		= $request->input('expenseaccount');
		$expensecategory 		= $request->input('expensecategory');
		$expensesubcategory 	= $request->input('expensesubcategory');
		$expensenote 			= $request->input('expensenote');
		$expensedate 			= $request->input('expensedate');
		$expensefile 			= $request->file('expensefile');
		
		//$message = ['incomefile.mimes'=>'Error! Please make sure file type are image or pdf'];
		
		
		$message = ['expensefile.mimes'=>trans('lang.upload_transaction')];
		
		
		if($request->hasFile('expensefile')) {
			$this->validate($request, [
            'expensefile' => 'image|mimes:jpeg,png,jpg,pdf|max:2048'
			],$message);
		
			$expensefilename 	= $request->file('expensefile')->getClientOriginalName();
			$request->file('expensefile')->move(public_path("/upload/expense"), $expensefilename);
			$data = DB::table('transaction')->where('transactionid',$id)
			->update(
				[
				'categoryid'		=>$expensesubcategory,
				'accountid'			=>$expenseaccount,
				'name'				=>$expensename,
				'amount'			=>$expenseamount,
				'reference'			=>$expensereference,
				'transactiondate'	=>$expensedate,
				'type'				=>'2',
				'description'		=>$expensenote,
				'file'				=>$expensefilename
				]
			);
		} else{
			$data = DB::table('transaction')->where('transactionid',$id)
			->update(
				[
				'categoryid'		=>$expensesubcategory,
				'accountid'			=>$expenseaccount,
				'name'				=>$expensename,
				'amount'			=>$expenseamount,
				'reference'			=>$expensereference,
				'transactiondate'	=>$expensedate,
				'type'				=>'2',
				'description'		=>$expensenote,
				]
			);
		
		}
		
		if($data){
				$res['success'] = true;
				$res['message']= 'Expense has been added';
				return response($res);
		}
    	
    }


    /**
	 * update account to database
	 *
	 * @param int     $id
	 * @param string  $incomeaccount
	 * @return object
	 */
	public function dopay(Request $request){
		$id      		  = $request->input('idincome');
		$incomeaccount    = $request->input('account');
		

		
			$data = DB::table('transaction')->where('transactionid',$id)
			->update(
				[
				
				'accountid'   =>$incomeaccount,
				'type'    =>'2',
				
				]
			);

		

		if($data){
			$res['success'] = true;
			$res['message']= 'Income has been received';
			return response($res);
		}

	}


	/**
	 * update data upcoming income to database
	 *
	 * @param int     $id
	 * @param string  $incomename
	 * @param double  $incomeamount
	 * @param string  $incomereference
	 * @param string  $incomeaccount
	 * @param string  $incomecategory
	 * @param string  $incomesubcategory
	 * @param string  $incomenote
	 * @param date    $incomedate
	 * @param string  $incomefile
	 * @return object
	 */
	public function saveeditupcoming(Request $request){
		$id      = $request->input('id');
		$incomename    = $request->input('editincomename');
		$incomeamount    = $request->input('editincomeamount');
		$incomereference   = $request->input('editincomereference');
		$incomeaccount = '0';
		$incomecategory   = $request->input('editincomecategory');
		$incomesubcategory   = $request->input('editincomesubcategory');
		$incomenote    = $request->input('editincomenote');
		$incomedate    = $request->input('editincomedate');
		$incomefile    = $request->file('editincomefile');

		$message = ['incomefile.mimes'=>trans('lang.upload_transaction')];


		if($request->hasFile('incomefile')) {
			$this->validate($request, [
				'incomefile' => 'image|mimes:jpeg,png,jpg,pdf|max:2048'
				],$message);

			$incomefilename  = $request->file('incomefile')->getClientOriginalName();
			$request->file('incomefile')->move(public_path("/upload/income"), $incomefilename);
			$data = DB::table('transaction')->where('transactionid',$id)
			->update(
				[
				'categoryid'  =>$incomesubcategory,
				'accountid'   =>$incomeaccount,
				'name'    =>$incomename,
				'amount'   =>$incomeamount,
				'reference'   =>$incomereference,
				'transactiondate' =>$incomedate,
				'type'    =>'4',
				'description'  =>$incomenote,
				'file'    =>$incomefilename
				]
			);
		} else{
			$data = DB::table('transaction')->where('transactionid',$id)
			->update(
				[
				'categoryid'  =>$incomesubcategory,
				'accountid'   =>$incomeaccount,
				'name'    =>$incomename,
				'amount'   =>$incomeamount,
				'reference'   =>$incomereference,
				'transactiondate' =>$incomedate,
				'type'    =>'4',
				'description'  =>$incomenote
				]
			);

		}

		if($data){
			$res['success'] = true;
			$res['message']= 'Upcoming Income has been added';
			return response($res);
		}

	}


	
	/**
	 * delete transaction expense to database
	 *
	 * @param integer $id
	 * @return object
	 */
	public function delete(Request $request){
		$id =	$request->input('iddelete');
		
		$delete = DB::table('transaction')->where('transactionid',$id)->delete();
		
		if($delete){
			$res['success'] = true;
			$res['message']= 'Expense has been deleted';
			return response($res);
		}
	}
	
	/**
	 * get single data expense 
	 *
	 * @param integer $id
	 * @return object
	 */
	public function getedit(Request $request){
    	$id 			= $request->input('id');

		$data = DB::table('transaction')
            ->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
			->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
            ->select('category.categoryid as categoryid2', 'transaction.*')
			->where('transaction.type','2')
			->where('transaction.transactionid',$id)
            ->get();
		
		if($data){
				$res['success'] = true;
				$res['message']= $data;
				return response($res);
		}
    }


    /**
	 * get single data upcomingincome from database
	 *
	 * @param integer $id
	 * @return object
	 */
	public function geteditupcoming(Request $request){
		$id    = $request->input('id');

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->select('category.categoryid as categoryid2', 'transaction.*')
		->where('transaction.type','4')
		->where('transaction.transactionid',$id)
		->get();

		if($data){
			$res['success'] = true;
			$res['message']= $data;
			return response($res);
		}
	}

    /**
	 * import CSV to Expense module
	 * @param string
	 * @return objext
	 */
	public function importcsv(Request $request){
		
		$message = ['csvfile.mimes'=>trans('lang.upload_transaction')];
		$userid =  Auth::id();
		$category = SubCategoryModel::pluck('subcategoryid')->toArray();
		$account = AccountModel::pluck('accountid')->toArray();
		if($request->hasFile('csvfile')){
			$this->validate($request, [
				'csvfile' => 'mimes:csv,txt|max:2048'
				],$message);

            $path = $request->file('csvfile')->getRealPath();
            $data = \Excel::load($path)->get();
           
            if($data->count()){
                foreach ($data as $key => $value) {
                    $arr[] = ['userid' => $userid, 'categoryid' => $value->subcategoryid, 
                    		 'accountid' => $value->accountid, 'name' => $value->name
                    		 , 'amount' => $value->amount, 'reference' => $value->reference
                    		 , 'transactiondate' => date("Y-m-d",strtotime($value->transactiondate)), 'type' => '2'
                    		 , 'description' => $value->description];
                
                	//check if category exist
				             if (!in_array($value->subcategoryid, $category)){
				             	return $res['message']= '2';
				             	exit;
				             }
                   	//check if account exist
                   			if (!in_array($value->accountid, $account)){
				             	return $res['message']= '3';
				             	exit;
				             }
                   	 		

                }
                if(!empty($arr)){
                	//dd($arr);
                    DB::table('transaction')->insert($arr);
					$res['message']= '1';
					
                }
            }
        }else{
        		$res['message']= '0';
    	}

    	return response($res);
	}
}

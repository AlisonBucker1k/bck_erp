<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\GoalModel;
use App\SettingModel;
use App\Http\Controllers\TraitSettings;
use DB;
use App;
use Auth;
class GoalController extends Controller
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
		if (Auth::user()->isrole('7')){
			return view( 'goals.index' );
		} else{
			 return redirect('home');
		}
	}

	/**
	 * get goal data from database
	 *
	 * @return object
	 */
	public function getdata() {
		$data = DB::table('goals')->get();
		return Datatables::of($data)
		->addColumn('balance', function($single) {
				$setting = DB::table('settings')->where('settingsid', '1')->get();
				return $setting[0]->currency.number_format($single->balance, 2);
			})
		->addColumn('amount', function($single) {
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->amount,2);
			})
		->addColumn('remaining',function($single){
				//buat deposit disini
				$setting = DB::table('settings')->where('settingsid','1')->get();
				$target   = $single->amount;
				$deposit   = $single->deposit;
				$balance   = $single->balance;
				$totaldeposit  = $deposit + $balance;
				$remaining   = $target - ($deposit + $balance);
				$percentage  = ($totaldeposit/$target)*100;
				return '
					<div class="progress" style="height:6px;">
						<div class="progress-bar progress-bar-success " role="progressbar"
						aria-valuenow="'.$percentage.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$percentage.'%">

						</div>
					</div>
					<div class="pull-left text-primary text-bold"><small>'.$setting[0]->currency.number_format($totaldeposit,2).' ('.number_format($percentage,2).'%)</small></div><div class="pull-right"><small>'.$setting[0]->currency.number_format($remaining,2).'</small></div>';
			})
		->addColumn('deadline',function($single){

				return date("d M Y",strtotime($single->deadline));
			})
		->addColumn('action', function ($accountsingle) {
				$target   = $accountsingle->amount;
				$deposit   = $accountsingle->deposit;
				$balance   = $accountsingle->balance;
				$totaldeposit  = $deposit + $balance;
				$remaining   = $target - ($deposit + $balance);

				if($remaining < 0 ){
					return '<span class="label label-success">Goal Reached</span>
					 <a href="#" id="btnedit" customdata='.$accountsingle->goalsid.' class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit"><i class="ti-pencil"></i> '. trans('lang.edit').'</a>
					<a href="#" id="btndelete" customdata='.$accountsingle->goalsid.' class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete"><i class="ti-trash"></i> '. trans('lang.delete').'</a>';
				}else{

					return '<a href="#" id="btndeposit" customdata='.$accountsingle->goalsid.' class="btn btn-sm btn-success" data-toggle="modal" data-target="#deposit"><i class="ti-plus"></i> '. trans('lang.deposit').'</a>
					 <a href="#" id="btnedit" customdata='.$accountsingle->goalsid.' class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit"><i class="ti-pencil"></i> '. trans('lang.edit').'</a>
					<a href="#" id="btndelete" customdata='.$accountsingle->goalsid.' class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete"><i class="ti-trash"></i> '. trans('lang.delete').'</a>';
				}
			})
		->rawColumns(['remaining', 'action'])->make(true);
	}

	/**
	 * insert data goal to database
	 *
	 * @param string  $name
	 * @param double  $opening
	 * @param date    $target
	 * @param date    $deadline
	 * @return object
	 */
	public function save(Request $request){

		$name    = $request->input('name');
		$opening   = $request->input('opening');
		$target   = $request->input('target');
		$deadline   = $request->input('deadline');
		$userid = Auth::id();
		$data = DB::table('goals')
		->insert(
			[
			'userid'   =>$userid,
			'name'    =>$name,
			'balance'   =>$opening,
			'amount'   =>$target,
			'deposit'   =>0,
			'deadline'   =>$deadline
			]
		);
		$res['success'] = true;
		$res['message']= 'goals have been added';

		return response($res);
	}

	/**
	 * add data deposit to database
	 *
	 * @param integer $id
	 * @param double  $deposit
	 * @return object
	 */
	public function deposit(Request $request){

		$deposit   = $request->input('deposit');
		$id    = $request->input('id');

		$getdeposit =  DB::table('goals')->where('goalsid',$id)->get();
		$depositdata = $getdeposit[0]->deposit;

		$data = DB::table('goals')->where('goalsid',$id)
		->update(
			[
			'deposit'   =>$depositdata+$deposit
			]
		);
		$res['success'] = true;
		$res['message']= 'deposit have been added';

		return response($res);
	}

	/**
	 * delete goal from database
	 *
	 * @param integer $id
	 * @return object
	 */
	public function deleteitem(Request $request){
		$id = $request->input('iddelete');

		$delete = DB::table('goals')->where('goalsid',$id)->delete();

		if($delete){
			$res['success'] = true;
			$res['message']= 'Budget has been deleted';
			return response($res);
		}
	}

	/**
	 * get single data goal from database
	 *
	 * @param integer $id
	 * @return object
	 */
	public function goalsgetedit(Request $request){
		$id    = $request->input('id');

		$data = DB::table('goals')->where('goalsid',$id)->get();

		if($data){
			$res['success'] = true;
			$res['message']= $data;
			return response($res);
		}
	}

	/**
	 * update data goal to database
	 *
	 * @param string  $name
	 * @param double  $opening
	 * @param date    $target
	 * @param date    $deadline
	 * @return object
	 */
	public function saveedit(Request $request){
		$id    = $request->input('id');
		$name    = $request->input('name');
		$opening   = $request->input('opening');
		$target   = $request->input('target');
		$deadline   = $request->input('date');
		$userid = Auth::id();
		$getdeposit =  DB::table('goals')->where('goalsid',$id)->get();
		$depositdata = $getdeposit[0]->deposit;

		$data = DB::table('goals')->where('goalsid',$id)
		->update(
			[
			'userid'   =>$userid,
			'name'    =>$name,
			'balance'   =>$opening,
			'amount'   =>$target,
			'deadline'   =>$deadline
			]
		);
		$res['success'] = true;
		$res['message']= 'goals have been updated';

		return response($res);
	}
}

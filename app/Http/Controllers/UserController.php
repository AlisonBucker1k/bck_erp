<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserModel;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\TraitSettings;
use DB;
use App\User;
use App;
use Auth;
class UserController extends Controller
{

	use TraitSettings;

	//construct
	public function __construct() {
		
		$data = $this->getapplications();
		$lang = $data[0]->languages;
		App::setLocale($lang);
		$this->middleware( 'auth' );
	}

	//get profile view
	public function profile() {
		return view( 'settings.profile.index' );
	}
	//get all users view
	public function allusers() {
		return view('settings.profile.users');
	/*	if (Auth::user()->isrole('17')){
           return view('settings.profile.users');
        } else{
             return redirect('home');
        }*/
	}

	/**
	 * get user profile
	 *
	 * @return object
	 */
	public function getprofile() {
		$id = Auth::id();
		$data = DB::table('users')->where('userid', $id)->get();
		if($data){
			$res['success'] = true;
			$res['data']  = $data;
			$res['message'] = 'list data';
			return response($res);
		}
	}

	/**
	 * get all users from database
	 *
	 * @return object
	 */
	public function getuser(){
		$data = DB::table('users')->get();
		return Datatables::of($data)
		->addColumn('action', function ($accountsingle) {
				return '<a href="#" id="btnedit" customdata='.$accountsingle->userid.' class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit"><i class="ti-pencil"></i> '. trans('lang.edit').'</a>
						<a href="#" id="btndelete" customdata='.$accountsingle->userid.' class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete"><i class="ti-trash"></i> '. trans('lang.delete').'</a>';
			})
		->setRowClass(function ($user) {
				return $user->status == 'Active' ? 'alert-success' : 'alert-warning';
			})
		->make(true);
	}


	/**
	 * insert  data users to database
	 *
	 * @param string  $name
	 * @param string  $email
	 * @param string  $phone
	 * @param string  $role
	 * @param string  $status
	 * @param string  $password
	 * @param string  $time
	 * @param date    $access
	 * @return object
	 */
	public function save(Request $request){
		$name    = $request->input('name');
		$email    = $request->input('email');
		$phone    = $request->input('phone');
		$role    = $request->input('role');
		$status   = $request->input('status');
		$password   = bcrypt($request->input('password'));
		$time    = date("Y-m-d h:i:s");
		$access   = $request->input('dataroles');

		$emailcheck = DB::table('users')
		    ->where('email', '=', $email)
		    ->first();

		if($emailcheck){
			$res['message'] = 'error';
			
		} 
		else{  
			$data = array('name'=>$name, 'email'=>$email, 'password'=>$password, 'phone'=>$phone,'role'=>$role,'status'=>$status,'updated_at'=>$time,'created_at'=>$time);
			$insert = DB::table('users')->insert($data);
			if($insert){
				$lastid = DB::getPdo()->lastInsertId();

				for($i=0; $i<count($access); $i++){

					$insertrole = DB::table('roleaccess')->insert(
						[
						'userid'   =>$lastid,
						'roleid'   =>$access[$i]
						]
					);
				}
				$res['success'] = true;
				$res['message']= $data;
				
			}
		}
			return response($res);

		}

	/**
	 * delete data user from database
	 *
	 * @param integer $id
	 * @return object
	 */
	public function delete(Request $request){
		$id = $request->input('iddelete');
		$delete = DB::table('users')->where('userid',$id)->delete();

		if($delete){
			$res['success'] = true;
			$res['message']= 'User has been deleted';
			return response($res);
		}
	}

	/**
	 * get single data user from database
	 *
	 * @param integer $id
	 * @return object
	 */
	public function getedit(Request $request){
		$id    = $request->input('id');

		$data   = DB::table('users')->where('userid',$id)->get();
		$datarole   = DB::table('roleaccess')->where('userid',$id)->get();
		if($data){
			$res['success'] = true;
			$res['user']= $data;
			$res['role']= $datarole;
			return response($res);
		}
	}

	/**
	 * get total users from database
	 *
	 * @return object
	 */
	public function totalusers(){
		$users = DB::table('users')->count();
		$active = DB::table('users')
		->select(DB::raw('ifnull(count(*),0) as user_count, status'))
		->where('status', '=', 'Active')
		->groupBy('status')
		->get();

		$inactive = DB::table('users')
		->select(DB::raw('ifnull(count(*),0) as user_count, status'))
		->where('status', '=', 'Inactive')
		->groupBy('status')
		->get();

		$admin = DB::table('users')
		->select(DB::raw('ifnull(count(*),0) as user_count, role'))
		->where('role', '=', 'Admin')
		->groupBy('role')
		->get();

		$res['totaluser']   = $users;
		$res['activeuser']   = $active;
		$res['inactiveuser']  = $inactive;
		$res['adminuser']   = $admin;

		return response($res);
	}

	/**
	 * update user profile
	 *
	 * @param string  $name
	 * @param string  $password
	 * @param string  $email
	 * @param string  $phone
	 * @return object
	 */
	public function saveprofile(Request $request){
		$name   = $request->input('name');
		$password  = $request->input('password');
		$email   = $request->input('email');
		$phone   = $request->input('phone');

		$id = Auth::id();

		if ($password !='') {

			$update = DB::table('users')->where('userid',$id)
			->update(
				[
				'name'    =>$name,
				'email'    =>$email,
				'password'   =>bcrypt($password),
				'phone'    =>$phone
				]
			);
		} else{

			$update = DB::table('users')->where('userid',$id)->update(
				[
				'name'   =>$name,
				'email'   =>$email,
				'phone'   =>$phone
				]
			);
		}

		if($update){
			$res['success'] = true;
			$res['message']= 'Settings has been updated';
			return response($res);
		}

	}

	/**
	 * save profile by admin user
	 *
	 * @param string  $name
	 * @param string  $password
	 * @param string  $email
	 * @param string  $phone
	 * @param string  $role
	 * @param string  $access
	 * @param integer $id
	 * @return object
	 */
	public function saveprofilebyadmin(Request $request){
		$name   = $request->input('name');
		$password  = $request->input('password');
		$email   = $request->input('email');
		$role   = $request->input('role');
		$status  = $request->input('status');
		$phone   = $request->input('phone');
		$id   = $request->input('id');
		$access  = $request->input('dataroles');

		if ($password !='') {

			$update = DB::table('users')->where('userid',$id)
			->update(
				[
				'name'    =>$name,
				'email'    =>$email,
				'password'   =>bcrypt($password),
				'phone'    =>$phone,
				'role'    =>$role,
				'status'   =>$status
				]
			);

			$delete = DB::table('roleaccess')->where('userid',$id)->delete();
			for($i=0; $i<count($access); $i++){
				$insertrole = DB::table('roleaccess')->insert(
					[
					'userid'   =>$id,
					'roleid'   =>$access[$i]
					]
				);
			};

			$res['success'] = true;
			$res['message']= 'Settings has been updated';
			return response($res);

		} else{

			$update = DB::table('users')->where('userid',$id)->update(
				[
				'name'   =>$name,
				'email'   =>$email,
				'phone'   =>$phone,
				'role'   =>$role,
				'status'  =>$status
				]
			);

			$delete = DB::table('roleaccess')->where('userid',$id)->delete();
			for($i=0; $i<count($access); $i++){
				$insertrole = DB::table('roleaccess')->insert(
					[
					'userid'   =>$id,
					'roleid'   =>$access[$i]
					]
				);
			};

			$res['success'] = true;
			$res['message']= 'Settings has been updated';
			return response($res);
		}


	}
}

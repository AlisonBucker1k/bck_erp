<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SettingModel;
use App\Http\Controllers\TraitSettings;
use DB;
use App;
use Auth;

class SettingController extends Controller
{

	use TraitSettings;

	public function __construct() {
		$data = $this->getapplications();
		$lang = $data[0]->languages;
		App::setLocale($lang);
		$this->middleware( 'auth' );
	}


	//application setttings
	public function applicationindex() {
		if (Auth::user()->isrole('18')){
           return view( 'settings.application.index' );
        } else{
             return redirect('home');
        }
	}

	/**
	 * get application settings
	 *
	 * @return object
	 */
	public function getapplication() {
		$data = DB::table('settings')->where('settingsid', '1')->get();
		if ($data) {

			$res['success'] = true;
			$res['data']  = $data;
			$res['logo']  = url('/').'/upload/'.$data[0]->logo;
			$res['message'] = 'list data';
			return response($res);
		}
	}

	/**
	 * get role access
	 *
	 * @return object
	 */
	public function getrole(){
		//update role
			DB::table('role')->where('roleid', '2')
			->update(['name'   => trans('lang.transactions')]);
			DB::table('role')->where('roleid', '3')
			->update(['name'   => trans('lang.income')]);
			DB::table('role')->where('roleid', '4')
			->update(['name'   => trans('lang.expense')]);
			DB::table('role')->where('roleid', '5')
			->update(['name'   => trans('lang.accounts')]);
			DB::table('role')->where('roleid', '6')
			->update(['name'   => trans('lang.track_budget')]);
			DB::table('role')->where('roleid', '7')
			->update(['name'   => trans('lang.set_goals')]);
			DB::table('role')->where('roleid', '8')
			->update(['name'   => trans('lang.calendar')]);
			DB::table('role')->where('roleid', '9')
			->update(['name'   => trans('lang.income_category')]);
			DB::table('role')->where('roleid', '10')
			->update(['name'   => trans('lang.expense_category')]);
			DB::table('role')->where('roleid', '11')
			->update(['name'   => trans('lang.income_reports')]);
			DB::table('role')->where('roleid', '12')
			->update(['name'   => trans('lang.expense_category')]);
			DB::table('role')->where('roleid', '13')
			->update(['name'   => trans('lang.income_vs_expense_reports')]);
			DB::table('role')->where('roleid', '14')
			->update(['name'   => trans('lang.income_monthly_report')]);
			DB::table('role')->where('roleid', '15')
			->update(['name'   => trans('lang.expense_monthly_report')]);
			DB::table('role')->where('roleid', '16')
			->update(['name'   => trans('lang.account_transaction_report')]);
			DB::table('role')->where('roleid', '17')
			->update(['name'   => trans('lang.user_role')]);
			DB::table('role')->where('roleid', '18')
			->update(['name'   => trans('lang.application_setting')]);
		$data = DB::table('role')->get();
		return response($data);
	}




	/**
	 * update application settings to database
	 *
	 * @param string  $company
	 * @param string  $phone
	 * @param string  $city
	 * @param string  $website
	 * @param string  $address
	 * @param string  $currency
	 * @param string  $language
	 * @param string  $dateformat
	 * @return object
	 */
	public function saveapplication(Request $request){
		$company  = $request->input('company');
		$phone   = $request->input('phone');
		$city   = $request->input('city');
		$website  = $request->input('website');
		$address  = $request->input('address');
		$currency  = $request->input('currency');
		$language  = $request->input('language');
		$dateformat  = $request->input('dateformat');
		$logoname2   = $request->file('logo');

		$message = ['logo.mimes'=>trans('lang.type_image')];



		if ($request->hasFile('logo')) {
			$this->validate($request, [
				'logo' => 'image|mimes:jpeg,png,jpg|max:2048'
				],$message);
			$logoname  = $request->file('logo')->getClientOriginalName();
			$request->file('logo')->move(public_path("/upload"), $logoname);
			$update = DB::table('settings')->where('settingsid', '1')
			->update(
				[
				'website'   =>$website,
				'company'   =>$company,
				'address'   =>$address,
				'currency'  =>$currency,
				'phone'    	=>$phone,
				'city'   	=>$city,
				'languages'    =>$language,
				'dateformat'    =>$dateformat,
				'logo'    =>$logoname
				]
			);
		} else{

			$update = DB::table('settings')->where('settingsid', '1')->update(
				[
				'company'   =>$company,
				'website'   =>$website,
				'address'   =>$address,
				'currency'   =>$currency,
				'city'    =>$city,
				'languages'    =>$language,
				'dateformat'    =>$dateformat,
				'phone'    =>$phone
				]
			);
		}

		
			
		if($update){
			$res['success'] = true;
			$res['message']= 'Settings has been updated';

			return response($res);
		}


	}
}

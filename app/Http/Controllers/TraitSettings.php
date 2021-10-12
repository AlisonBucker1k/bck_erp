<?php
namespace App\Traits;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SettingModel;
use DB;
use App;
use Auth;

trait TraitSettings {

	/**
	 * get application settings
	 *
	 * @return object
	 */
	public function getapplications() {
		$data = DB::table('settings')->where('settingsid', '1')->get();
		return json_decode($data);
	}

}
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Validator;
use Carbon\Carbon;

/**
 * Description of companyprofile
 *
 * @author mohamed
 */
class companyprofile extends Controller {

    //put your code here3
    public function passwordEdit() {
        return view('manasek.companypasswordEdit');
    }

    public function passwordEditPost(Request $request) {
        $rules = [
            'oldpassword' => 'required|min:6|max:100',
            'newpassword' => 'required|min:6|max:100',
            'newpasswordre' => 'required|same:newpassword',
        ];
        $nicenames = [
            'oldpassword' => trans('company.oldpassword'),
            'newpassword' => trans('company.newpassword'),
            'newpasswordre' => trans('company.newpasswordre'),
        ];
        $validiator = Validator::make($request->all(), $rules);
        $validiator->setAttributenames($nicenames);
        if ($validiator->fails()) {
            return redirect()->back()
                            ->withErrors($validiator);
        } else {
            $oldpasswordcrypted = md5(crypt($request->input('oldpassword'), SHUMOOLSALT));
            $newpasswordcrypted = md5(crypt($request->input('newpassword'), SHUMOOLSALT));
            $oldpasswordCheck = DB::table('front_larausers')
                    ->where('id', '=', $request->session()->get('companyID'))
                    ->first();
            if ($oldpasswordCheck->user_password == $oldpasswordcrypted) {
                $paswsordupdate = DB::table('front_larausers')
                        ->where('id', '=', $request->session()->get('companyID'))
                        ->update(['user_password' => $newpasswordcrypted]);
                if ($paswsordupdate) {
                    $request->session()->flash('alert-success', trans('company.passwordEditsuccessfully'));
                    return redirect('/company/passwordEdit');
                } else {
                    return redirect()->back()
                                    ->withErrors(trans('company.updatepasswordError'));
                }
            } else {
                return redirect()->back()
                                ->withErrors(trans('company.oldpasswordError'));
            }
        }
    }

    public function profileEdit(Request $request) {
        $lkp_agency_type = DB::table('lkp_agency_type')
                ->orderBy('AGENCY_TYPE_ID', 'ASC')
                ->where('ACTIVE_FLAG', '=', '1')
                ->get();
        $lkp_activity_type = DB::table('lkp_activity_type')
                ->orderBy('ACTIVITY_TYPE_ID', 'ASC')
                ->where('ACTIVE_FLAG', '=', '1')
                ->get();
        $lkp_country = DB::table('lkp_country')
                ->orderBy('COUNTRY_ID', 'ASC')
                ->where('ACTIVE_FLAG', '=', '1')
                ->get();
		$lst_country =[];
		foreach($lkp_country as $row){
			$lst_country[$row->COUNTRY_ID]= $row->COUNTRY_NAME_AR;
		}
        $lkp_currency = DB::table('lkp_currency')
                ->orderBy('CURRENCY_ID', 'ASC')
                ->where('ACTIVE_FLAG', '=', '1')
                ->get();
		$lst_currency =[];
		foreach($lkp_currency as $row){
			$lst_currency[$row->CURRENCY_ID]= $row->CURRENCY_NAME_AR;
		}
        $lkp_city = DB::table('lkp_city')
                ->orderBy('CITY_ID', 'ASC')
                ->where('ACTIVE_FLAG', '=', '1')
                ->get();
		$lst_city =[];
		foreach($lkp_city as $row){
			$lst_city[$row->CITY_ID]= $row->CITY_NAME_AR;
		}
        $lkp_area = DB::table('lkp_area')
                ->orderBy('AREA_ID', 'ASC')
                ->where('ACTIVE_FLAG', '=', '1')
                ->get();
		$lst_area =[];
		foreach($lkp_area as $row){
			$lst_area[$row->AREA_ID]= $row->AREA_NAME_AR;
		}
		$companyID = $request->session()->get('companyID'); // User_id
        $agency = DB::table('agency')
                ->where('front_user_id', '=', $companyID)
                ->first();
        $result_agency_activity = DB::table('agency_activity')
                ->select('ACTIVITY_ID')
                ->where('AGENCY_ID', '=', $agency->AGENCY_ID)
                ->get();
		$agency_activity =[];
		foreach($result_agency_activity as $row){
			$agency_activity[]= $row->ACTIVITY_ID;
		}
        return view('manasek.profileEdit')
                        ->with('lkp_agency_types', $lkp_agency_type)
                        ->with('lkp_activity_types', $lkp_activity_type)
                        ->with('lst_country', $lst_country)
                        ->with('lst_currency', $lst_currency)
                        ->with('lst_city', $lkp_city)
                        ->with('data_agency', $agency)
                        ->with('agency_activity', $agency_activity)
                        ->with('lst_area', $lkp_area);
    }

    public function profileEditPost(Request $request) {
        $rules = [
            'company_type' => 'required',
            'activity_type' => 'required',
            'coutryID' => 'required',
            'comname' => 'required',
            'haj_approved' => 'required',
            'city' => 'required',
            'area' => 'required',
            'address' => 'required',
            'com_desc' => 'required',
/*		    'com_logo'=>'required|image|mimes:jpeg,jpg,bmp,png,gif|max:3000',*/
            'licensenumber' => 'required',
        ];
        $nicenames = [
            'company_type' => trans('company.companytype'),
            'activity_type' => trans('company.activitytype'),
            'coutryID' => trans('company.country'),
            'comname' => trans('company.companyName'),
            'saulice' => trans('company.saulice'),
            'city' => trans('company.city'),
            'area' => trans('company.area'),
            'address' => trans('company.address'),
            'com_desc' => trans('company.com_desc'),
            'licensenumber' => trans('company.licensenumber'),
        ];
        $validiator = Validator::make($request->all(), $rules);
        $validiator->setAttributenames($nicenames);
        if ($validiator->fails()) {
            return redirect()->back()
                            ->withErrors($validiator);
        } else {
		$companyID = $request->session()->get('companyID'); // User_id
        $agency = DB::table('agency')
                ->where('front_user_id', '=', $companyID)
                ->first();
		$agency_id = $agency->AGENCY_ID;					// Companyid
		$fileName = $agency->AGENCY_LOGO;
		/*    Agency Logo Upload  */ 
		$files = $request->file('com_logo');
		if($files) {
			$destinationPath = 'uploads'; // upload path
			$extension = $files->getClientOriginalExtension(); // getting image extension
			$fileName = 'logo_'.time().'.'.$extension; // renameing image
			$upload_success = $files->move($destinationPath, $fileName);
		}
		/*    END Agency Logo Upload  */ 

		DB::table('agency')
            ->where('AGENCY_ID', $agency_id)
            ->update([
			'AGENCY_TYPE' => $request->company_type,
			'COUNTRY_ID' => $request->coutryID,
			'AGENCY_NAME' => $request->comname,
			'CAPITAL_AMOUNT' => $request->capital,
			'CAPITAL_CURRENCY_ID' => $request->capital_currency,
			'ANNUAL_VOLUME' => $request->anv,
			'LICENSE_NO' => $request->licensenumber,
			'EMPLOYEE_NO' => $request->empnumber,
			'KSA_HAJ_APPROVED' => $request->haj_approved,
			'POSTAL_CODE' => $request->zip,
			'CITY_ID' => $request->city,
			'AREA_ID' => $request->area,
			'ADDRESS' => $request->address,
			'googlemap' => $request->googlemap,
			'AGENCY_URL' => $request->com_website,
			'AGENCY_LOGO' => $fileName,
			'AGENCY_DESCRIPTION' => $request->com_desc
			]);
		/*  AGENCY ACTIVITY  TABLE */ 
			$affectedRows = DB::table('agency_activity')->where('AGENCY_ID', '=', $agency_id)->delete();
			$sqlInsert = [];
			foreach($request->activity_type as $activity){
				$sqlInsert[] = array('ACTIVITY_ID'=>$activity, 'AGENCY_ID'=>$agency_id);
			}
			DB::table('agency_activity')->insert($sqlInsert);
		/*  EnD AGENCY ACTIVITY  TABLE */ 
			
		$request->session()->flash('alert-success', trans('company.branchesEditSucces'));
		return redirect('/company/profileEdit/');


//		echo "<hr>".$agency_id;
//		echo "<PRE>";
//		print_r($sqlInsert);
//		echo "</PRE>";
//		echo "<PRE>";
//		print_r($files);
//		echo "</PRE>";
//		echo "<hr>".$request->company_type;
//		echo "<hr>".$request->coutryID;
//		echo "<hr>".$request->comname;
//		echo "<hr>".$request->capital;
//		echo "<PRE>";
//		print_r($request->all());
//		echo "</PRE>";
            
        }
    }

}

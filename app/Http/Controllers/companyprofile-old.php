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

    public function profileEdit() {
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
        $lkp_currency = DB::table('lkp_currency')
                ->orderBy('CURRENCY_ID', 'ASC')
                ->where('ACTIVE_FLAG', '=', '1')
                ->get();
        $lkp_city = DB::table('lkp_city')
                ->orderBy('CITY_ID', 'ASC')
                ->where('ACTIVE_FLAG', '=', '1')
                ->get();
        $lkp_area = DB::table('lkp_area')
                ->orderBy('AREA_ID', 'ASC')
                ->where('ACTIVE_FLAG', '=', '1')
                ->get();
        return view('manasek.profileEdit')
                        ->with('lkp_agency_types', $lkp_agency_type)
                        ->with('lkp_activity_types', $lkp_activity_type)
                        ->with('lkp_countries', $lkp_country)
                        ->with('lkp_currencies', $lkp_currency)
                        ->with('lkp_cities', $lkp_city)
                        ->with('lkp_areas', $lkp_area);
    }

    public function profileEditPost(Request $request) {
        $rules = [
            'company_type' => 'required',
            'activity_type' => 'required',
            'coutryID' => 'required',
            'comname' => 'required',
            'saulice' => 'required',
            'city' => 'required',
            'area' => 'required',
            'address' => 'required',
            'com_desc' => 'required',
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
            
        }
    }

}

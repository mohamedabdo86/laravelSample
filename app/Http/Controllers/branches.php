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
 * Description of branches
 *
 * @author mohamed
 */
class branches extends Controller {

    //put your code here
    public function addbranch(Request $request) {
        $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
        if ($checkCompanyActive->ACTIVE_FLAG == 1) {
            $lkp_city = DB::table('lkp_city')
                    ->orderBy('CITY_ID', 'ASC')
                    ->where('ACTIVE_FLAG', '=', '1')
                    ->get();
            $lkp_area = DB::table('lkp_area')
                    ->orderBy('AREA_ID', 'ASC')
                    ->where('ACTIVE_FLAG', '=', '1')
                    ->get();
            return view('manasek.addbranch')
                            ->with('active', 'yes')
                            ->with('companyName', $checkCompanyActive->AGENCY_NAME)
                            ->with('lkp_cities', $lkp_city)
                            ->with('lkp_areas', $lkp_area);
        } else {
            return view('manasek.addbranch')->with('active', 'none');
        }
    }

    public function addbranchPost(Request $request) {
        $rules = [
            'branchName' => 'required',
            'city' => 'required',
            'area' => 'required',
            'address' => 'required',
            'prefcon' => 'required',
        ];

        $nicenames = [
            'branchName' => trans('company.branchName'),
            'city' => trans('company.city'),
            'area' => trans('company.area'),
            'address' => trans('company.address'),
            'prefcon' => trans('company.prefcon'),
        ];
        if ($request->input('prefcon') == trans('company.companyEmail')) {
            $rules['prefconValue'] = 'required|email';
            $nicenames['prefconValue'] = trans('company.prefconValue');
        } elseif ($request->input('prefcon') == trans('company.phone')) {
            $rules['prefconValue'] = array('required', 'regex:/^(\+|00)[1-9]{1,3}(\.|\s|-)?([0-9]{1,5}(\.|\s|-)?){1,3}$/');
            $nicenames['prefconValue'] = trans('company.prefconon');
        }
        $validiator = Validator::make($request->all(), $rules);
        $validiator->setAttributenames($nicenames);
        if ($validiator->fails()) {
            return redirect()->back()
                            ->withErrors($validiator)
                            ->withInput();
        } else {
            $checkCompanyActive = DB::table('agency')
                    ->where('front_user_id', '=', $request->session()->get('companyID'))
                    ->first();
            $branchInsert = DB::table('agency_branch')
                    ->insert([
                'AGENCY_ID' => $checkCompanyActive->AGENCY_ID,
                'BRANCH_NAME' => $request->input('branchName'),
                'CITY_ID' => $request->input('city'),
                'AREA_ID' => $request->input('area'),
                'ADDRESS' => $request->input('address'),
                'POSTAL_CODE' => $request->input('zip'),
            ]);
            if ($branchInsert) {
                $request->session()->flash('alert-success', trans('company.branchesAddedSucces'));
                return redirect('/company/addbranch');
            }
        }
    }

    public function showbranches(Request $request) {
        $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
        $branches = DB::table('agency_branch')
                        ->where('AGENCY_ID', '=', $checkCompanyActive->AGENCY_ID)
                        ->orderBy('AGENCY_BRANCH_ID', 'ASC')->paginate(10);
        return view('manasek.showbranches')->with('allbranches', $branches);
    }

    public function branchDesc($id, Request $request) {
        $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
        $branches = DB::table('agency_branch')
                ->where('AGENCY_BRANCH_ID', '=', $id)
                ->first();
        $branchCity = DB::table('lkp_city')
                ->where('CITY_ID', '=', $branches->CITY_ID)
                ->first();
        $branchArea = DB::table('lkp_area')
                ->where('AREA_ID', '=', $branches->AREA_ID)
                ->first();
        if ($checkCompanyActive->ACTIVE_FLAG == 1) {
            return view('manasek.branchDesc')
                            ->with('branches', $branches)
                            ->with('branchCity', $branchCity)
                            ->with('branchArea', $branchArea)
                            ->with('active', 'yes')
                            ->with('companyName', $checkCompanyActive->AGENCY_NAME)
            ;
        } else {
            return view('manasek.addbranch')->with('active', 'none');
        }
    }

    public function branchdelete($id) {
        $branchdelete = DB::table('agency_branch')
                ->where('AGENCY_BRANCH_ID', '=', $id)
                ->delete();
        return redirect('/company/showbranches');
    }

    public function branchedit($id, Request $request) {
        $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
        if ($checkCompanyActive->ACTIVE_FLAG == 1) {
            $branches = DB::table('agency_branch')
                    ->where('AGENCY_BRANCH_ID', '=', $id)
                    ->first();
            $lkp_city = DB::table('lkp_city')
                    ->orderBy('CITY_ID', 'ASC')
                    ->where('ACTIVE_FLAG', '=', '1')
                    ->get();
            $lkp_area = DB::table('lkp_area')
                    ->orderBy('AREA_ID', 'ASC')
                    ->where('ACTIVE_FLAG', '=', '1')
                    ->get();
            return view('manasek.editbranch')
                            ->with('active', 'yes')
                            ->with('branches', $branches)
                            ->with('companyName', $checkCompanyActive->AGENCY_NAME)
                            ->with('lkp_cities', $lkp_city)
                            ->with('lkp_areas', $lkp_area);
        } else {
            return view('manasek.editbranch')->with('active', 'none');
        }
    }

    public function brancheditpost($id, Request $request) {
        $rules = [
            'branchName' => 'required',
            'city' => 'required',
            'area' => 'required',
            'address' => 'required',
            'prefcon' => 'required',
        ];

        $nicenames = [
            'branchName' => trans('company.branchName'),
            'city' => trans('company.city'),
            'area' => trans('company.area'),
            'address' => trans('company.address'),
            'prefcon' => trans('company.prefcon'),
        ];
        if ($request->input('prefcon') == trans('company.companyEmail')) {
            $rules['prefconValue'] = 'required|email';
            $nicenames['prefconValue'] = trans('company.prefconValue');
        } elseif ($request->input('prefcon') == trans('company.phone')) {
            $rules['prefconValue'] = array('required', 'regex:/^(\+|00)[1-9]{1,3}(\.|\s|-)?([0-9]{1,5}(\.|\s|-)?){1,3}$/');
            $nicenames['prefconValue'] = trans('company.prefconon');
        }
        $validiator = Validator::make($request->all(), $rules);
        $validiator->setAttributenames($nicenames);
        if ($validiator->fails()) {
            return redirect()->back()
                            ->withErrors($validiator)
                            ->withInput();
        } else {
            $checkCompanyActive = DB::table('agency')
                    ->where('front_user_id', '=', $request->session()->get('companyID'))
                    ->first();
            $branchInsert = DB::table('agency_branch')
                    ->where('AGENCY_BRANCH_ID', '=', $id)
                    ->update([
                'AGENCY_ID' => $checkCompanyActive->AGENCY_ID,
                'BRANCH_NAME' => $request->input('branchName'),
                'CITY_ID' => $request->input('city'),
                'AREA_ID' => $request->input('area'),
                'ADDRESS' => $request->input('address'),
                'POSTAL_CODE' => $request->input('zip'),
            ]);
            $request->session()->flash('alert-success', trans('company.branchesEditSucces'));
            return redirect('company/branch/edit/' . $id);
        }
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Validator;
use Carbon\Carbon;

class companydashboard extends Controller {

    public function Index(Request $request) {
        return view('manasek.dashboard');
    }

    public function uploadFiles(Request $request) {
        // getting all of the post data

        $files = $request->file('file');
        // Making counting of uploaded images
        $file_count = count($files);
        // start count how many uploaded
        $uploadcount = 0;
        foreach ($files as $file) {
            $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
            $validator = Validator::make(array('file' => $file), $rules);
            if ($validator->passes()) {
                $destinationPath = 'uploads';

                $filename = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 60)
                        . "-" . $request->session()->get('companyID') . "-" . $file->getClientOriginalName();
                $upload_success = $file->move($destinationPath, $filename);
                $filenamee[] = $filename;
                $uploadcount ++;
            }
        }
        if ($uploadcount == $file_count) {
            $checkFound = DB::table('agency')
                    ->where('front_user_id', '=', $request->session()->get('companyID'))
                    ->get();
            if ($checkFound) {
                $agencyInsert = DB::table('agency')
                        ->where('front_user_id', '=', $request->session()->get('companyID'))
                        ->update([
                    'front_user_id' => $request->session()->get('companyID'),
                    'commercialRegisterfile' => $filenamee['0'],
                    'licensefile' => $filenamee['1'],
                    'saafile' => $filenamee['2'],
                ]);
            } else {
                $fkcheckoff = DB::select('SET foreign_key_checks = 0;');
                $agencyInsert = DB::table('agency')
                        ->insert([
                    'front_user_id' => $request->session()->get('companyID'),
                    'commercialRegisterfile' => $filenamee['0'],
                    'licensefile' => $filenamee['1'],
                    'saafile' => $filenamee['2'],
                ]);
                $fkcheckoff = DB::select('SET foreign_key_checks = 1;');
            }
            if ($agencyInsert) {
                $request->session()->flash('alert-success', trans('company.uploadsuccessfully'));
                return redirect('/company/dashboard');
            } else {
                return redirect('/company/dashboard')->withInput()->withErrors($validator);
            }
        } else {
            return redirect('/company/dashboard')->withInput()->withErrors($validator);
        }
    }

}

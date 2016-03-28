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
 * Description of programs
 *
 * @author mohamed
 */
class reqPrograms extends Controller {

    public function viewreqprog(Request $request, $activityID = 1) {
        $view = view('manasek.viewreqprog');
        $activityName = DB::table('lkp_activity_type')
                ->where('ACTIVITY_TYPE_ID', '=', $activityID)
                ->first();
        $view->with('activityName', $activityName);
        $allprograms = DB::table('program_request')
                ->where('PUBLISH_PROGRAM', '=', 1)
                ->where('PROGRAM_TYPE_ID', '=', $activityID)
                ->join('applicant', 'program_request.APPLICANT_ID', '=', 'applicant.APPLICANT_ID')
                ->paginate(10);
        $view->with('allprograms', $allprograms);
        return $view;
    }

}

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
 * Description of search
 *
 * @author mohamed
 */
class search extends Controller {

    //put your code here
    public function index(Request $request) {
        $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
        if ($checkCompanyActive->ACTIVE_FLAG == 1) {
            $lkp_season = DB::table('lkp_season')
                    ->orderBy('SEASON_ID', 'ASC')
                    ->where('ACTIVE_FLAG', '=', '1')
                    ->lists('SEASON_TYPE_AR', 'SEASON_ID');

            $lkp_travel_method = DB::table('lkp_travel_method')
                    ->orderBy('TRAVEL_METHOD_ID', 'Desc')
                    ->where('ACTIVE_FLAG', '=', '1')
                    ->lists('TRAVEL_METHOD_AR', 'TRAVEL_METHOD_ID');
            $program_price = DB::table('program_price')
                    ->orderBy('PROGRAM_PRICE_ID', 'Desc')
                    ->lists('PRICE', 'PROGRAM_PRICE_ID');
			$lkp_country = DB::table('lkp_country')
                ->orderBy('COUNTRY_ID', 'ASC')
                ->where('ACTIVE_FLAG', '=', '1')
                ->lists('COUNTRY_NAME_AR', 'COUNTRY_ID');
			$lkp_city = DB::table('lkp_city')
                ->orderBy('CITY_ID', 'ASC')
                ->where('ACTIVE_FLAG', '=', '1')
                ->get();
			$lkp_accommodation_grade = DB::table('lkp_accommodation_grade')
                ->orderBy('ACCOMMODATION_GRADE_ID', 'ASC')
                ->where('ACTIVE_FLAG', '=', '1')
                ->lists('GRADE_NAME_AR', 'ACCOMMODATION_GRADE_ID');
			
			$lkp_program_level = DB::table('lkp_program_level')
                    ->orderBy('PROGRAM_LEVEL_ID', 'ASC')
                    ->where('ACTIVE_FLAG', '=', '1')
                    ->get();
			$lkp_port = DB::table('lkp_port')
                    ->where('ACTIVE_FLAG', '=', 1)
					->lists('PORT_NAME_AR', 'TRAVEL_METHOD_ID');
			$lkp_airlines = DB::table('lkp_airline')
					->where('ACTIVE_FLAG', '=', 1)
					->lists('AIRLINE_NAME_AR', 'AIRLINE_ID');
            return view('manasek.search')
                            ->with('active', 'yes')
                            ->with('lkp_season', $lkp_season)
                            ->with('lkp_travel_methods', $lkp_travel_method)
                            ->with('program_price', $program_price)
                            ->with('lkp_country', $lkp_country)
                            ->with('lkp_city', $lkp_city)
                            ->with('lkp_accommodation_grade', $lkp_accommodation_grade)
                            ->with('lkp_port', $lkp_port)
                            ->with('lkp_airlines', $lkp_airlines)
                            ->with('lkp_program_levels', $lkp_program_level);
        } else {
            return view('manasek.search')->with('active', 'none');
        }
    }


    public function getResult(Request $request) {
		
//		echo "<PRE>";
//		print_r($request->all());
//		echo "</PRE>";

        $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
        if ($checkCompanyActive->ACTIVE_FLAG == 1) {
            $lkp_season = DB::table('lkp_season')
                    ->orderBy('SEASON_ID', 'ASC')
                    ->where('ACTIVE_FLAG', '=', '1')
                    ->lists('SEASON_TYPE_AR', 'SEASON_ID');

            $lkp_travel_method = DB::table('lkp_travel_method')
                    ->orderBy('TRAVEL_METHOD_ID', 'Desc')
                    ->where('ACTIVE_FLAG', '=', '1')
                    ->lists('TRAVEL_METHOD_AR', 'TRAVEL_METHOD_ID');
            $program_price = DB::table('program_price')
                    ->orderBy('PROGRAM_PRICE_ID', 'Desc')
                    ->lists('PRICE', 'PROGRAM_PRICE_ID');
			$lkp_country = DB::table('lkp_country')
                ->orderBy('COUNTRY_ID', 'ASC')
                ->where('ACTIVE_FLAG', '=', '1')
                ->lists('COUNTRY_NAME_AR', 'COUNTRY_ID');
			$lkp_city = DB::table('lkp_city')
                ->orderBy('CITY_ID', 'ASC')
                ->where('ACTIVE_FLAG', '=', '1')
                ->get();
			$lkp_accommodation_grade = DB::table('lkp_accommodation_grade')
                ->orderBy('ACCOMMODATION_GRADE_ID', 'ASC')
                ->where('ACTIVE_FLAG', '=', '1')
                ->lists('GRADE_NAME_AR', 'ACCOMMODATION_GRADE_ID');
			
			$lkp_program_level = DB::table('lkp_program_level')
                    ->orderBy('PROGRAM_LEVEL_ID', 'ASC')
                    ->where('ACTIVE_FLAG', '=', '1')
                    ->get();
			$lkp_port = DB::table('lkp_port')
                    ->where('ACTIVE_FLAG', '=', 1)
					->lists('PORT_NAME_AR', 'TRAVEL_METHOD_ID');
			$lkp_airlines = DB::table('lkp_airline')
					->where('ACTIVE_FLAG', '=', 1)
					->lists('AIRLINE_NAME_AR', 'AIRLINE_ID');
            return view('manasek.search')
                            ->with('active', 'yes')
                            ->with('lkp_season', $lkp_season)
                            ->with('lkp_travel_methods', $lkp_travel_method)
                            ->with('program_price', $program_price)
                            ->with('lkp_country', $lkp_country)
                            ->with('lkp_city', $lkp_city)
                            ->with('lkp_accommodation_grade', $lkp_accommodation_grade)
                            ->with('lkp_port', $lkp_port)
                            ->with('lkp_airlines', $lkp_airlines)
                            ->with('lkp_program_levels', $lkp_program_level);
        } else {
            return view('manasek.search')->with('active', 'none');
        }
	}

}
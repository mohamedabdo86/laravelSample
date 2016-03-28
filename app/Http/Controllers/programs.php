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
class programs extends Controller {

    //put your code here
    public function addhajprog(Request $request, $activityID = 1) {
        $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
        if ($checkCompanyActive->ACTIVE_FLAG == 1) {
            $lkp_travel_method = DB::table('lkp_travel_method')
                    ->orderBy('TRAVEL_METHOD_ID', 'ASC')
                    ->where('ACTIVE_FLAG', '=', '1')
                    ->get();
            $lkp_activity_type = DB::table('lkp_activity_type')
                    ->where('ACTIVITY_TYPE_ID', '=', $activityID)
                    ->first();
            $lkp_program_level = DB::table('lkp_program_level')
                    ->orderBy('PROGRAM_LEVEL_ID', 'ASC')
                    ->where('ACTIVE_FLAG', '=', '1')
                    ->get();
            $lkp_seasons = DB::table('lkp_season')
                    ->where('SEASON_TYPE', '=', $activityID)
                    ->where('ACTIVE_FLAG', '=', 1)
                    ->orderBy('SEASON_ID', 'ASC')
                    ->get();
            return view('manasek.addhajprog')
                            ->with('active', 'yes')
                            ->with('lkp_travel_methods', $lkp_travel_method)
                            ->with('lkp_program_levels', $lkp_program_level)
                            ->with('lkp_activity_type', $lkp_activity_type)
                            ->with('lkp_seasons', $lkp_seasons);
        } else {
            return view('manasek.addhajprog')->with('active', 'none');
        }
    }

    public function showHajProg(Request $request, $activityID = 1) {
        $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
        $activityName = DB::table('lkp_activity_type')
                ->where('ACTIVITY_TYPE_ID', '=', $activityID)
                ->first();
        $programs = DB::table('program')
                        ->where('AGENCY_ID', '=', $checkCompanyActive->AGENCY_ID)
                        ->where('PROGRAM_TYPE_ID', '=', $activityID)
                        ->orderBy('PROGRAM_ID', 'DESC')->paginate(10);
        return view('manasek.showprograms')->with('allprograms', $programs)
                        ->with('activityName', $activityName);
    }

    public function programview(Request $request, $id, $activityID = 1) {
        $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
        $view = view('manasek.showprog');

        $programs = DB::table('program')
                ->where('PROGRAM_ID', '=', $id)
                //->join('lkp_program_level', 'program.PROGRAM_LEVEL_ID', '=', 'lkp_program_level.PROGRAM_LEVEL_ID')
                ->first();
        if (is_object($programs)) {
            $view->with('prog', $programs);
            $seasonName = DB::table('lkp_season')
                    ->where('SEASON_ID', '=', $programs->SEASON_ID)
                    ->first();
            $view->with('seasonName', $seasonName); 
            $lkp_travel_method = DB::table('lkp_travel_method')
                    ->where('TRAVEL_METHOD_ID', '=', $programs->TRAVEL_METHOD_ID)
                    ->first();
            $view->with('lkp_travel_method', $lkp_travel_method);
            $lkp_program_level = DB::table('lkp_program_level')
                    ->where('PROGRAM_LEVEL_ID', '=', $programs->PROGRAM_LEVEL_ID)
                    ->first();
            $view->with('lkp_program_level', $lkp_program_level);
            $program_transportation = DB::table('program_transportation')
                    ->where('PROGRAM_ID', '=', $id)
                    ->join('lkp_port', 'program_transportation.FROM_PORT_ID', '=', 'lkp_port.PORT_ID')
                    ->first();
            $view->with('programtransportation', $program_transportation);
            if ($program_transportation) {
                $TO_PORT_Name = DB::table('lkp_port')
                        ->where('PORT_ID', '=', $program_transportation->TO_PORT_ID)
                        ->first();
                $view->with('TO_PORT_Name', $TO_PORT_Name->PORT_NAME_AR);
                $FROM_PORT_NameRE = DB::table('lkp_port')
                        ->where('PORT_ID', '=', $program_transportation->FROM_PORT_IDRE)
                        ->first();
                $view->with('FROM_PORT_NameRE', $FROM_PORT_NameRE->PORT_NAME_AR);
                $TO_PORT_NameRE = DB::table('lkp_port')
                        ->where('PORT_ID', '=', $program_transportation->TO_PORT_IDRE)
                        ->first();
                $view->with('TO_PORT_NameRE', $TO_PORT_NameRE->PORT_NAME_AR);
            }

            if ($programs->TRAVEL_METHOD_ID == 3) {
                $lkp_airline = DB::table('lkp_airline')
                        ->where('AIRLINE_ID', '=', $program_transportation->AIRLINE_ID)
                        ->first();
                $view->with('lkp_airline', $lkp_airline->AIRLINE_NAME_AR);
                $lkp_airlineRE = DB::table('lkp_airline')
                        ->where('AIRLINE_ID', '=', $program_transportation->AIRLINE_IDRE)
                        ->first();
                $view->with('lkp_airlineRE', $lkp_airlineRE->AIRLINE_NAME_AR);
            }
            if ($programs->TRAVEL_METHOD_ID) {
                $programmethod = DB::table('lkp_travel_method')
                        ->where('TRAVEL_METHOD_ID', '=', $programs->TRAVEL_METHOD_ID)
                        ->first();
                $view->with('progmethod', $programmethod);
            }
            $programaccommod = DB::table('program_accommodation')
                    ->where('PROGRAM_ID', '=', $programs->PROGRAM_ID)
                    ->join('lkp_city', 'program_accommodation.CITY_ID', '=', 'lkp_city.CITY_ID')
                    ->join('lkp_hotels', 'program_accommodation.HOTEL_ID', '=', 'lkp_hotels.HOTEL_ID')
                    ->join('lkp_accommodation_grade', 'program_accommodation.ACCOMMODATION_GRADE_ID', '=', 'lkp_accommodation_grade.ACCOMMODATION_GRADE_ID')
                    ->get();
            $view->with('programaccommod', $programaccommod);
            $oldprices = DB::table('program_price')
                    ->join('lkp_age_category', 'program_price.AGE_CATEGORY_ID', '=', 'lkp_age_category.AGE_CATEGORY_ID')
                    ->join('lkp_currency', 'program_price.CURRENCY_ID', '=', 'lkp_currency.CURRENCY_ID')
                    ->where('PROGRAM_ID', '=', $id)
                    ->orderBy('PROGRAM_PRICE_ID', 'DESC')
                    ->get();
           $favProgAdded = DB::table('applicant_favorite_program')
                   ->where('PROGRAM_ID', '=', $programs->PROGRAM_ID)
                   ->count();
           $progOrders = DB::table('applicant_reservation')
                   ->where('PROGRAM_ID', '=', $programs->PROGRAM_ID)
                   ->count();
           $view->with('progOrders', $progOrders);
           $view->with('favProgAdded', $favProgAdded);
            $view->with('oldprices', $oldprices);
            $view->with('id', $id);
            $view->with('activityID', $activityID);
        }
        //if ($programs->PROGRAM_ID){
        // if ($programaccommod){
        // $programhotel = DB::table('lkp_hotels')
        //         ->where('HOTEL_ID', '=', $programaccommod->HOTEL_ID)
        //         ->first();
        // $view->with('proghotel', $programhotel);
        // }
        // }
        return $view;
        //view('manasek.showprog')
        // ->with('progmethod', $programmethod)
        //  ->with('proghotel', $programhotel)
    }

    public function showUmraprograms(Request $request, $activityID = 2) {
        $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
        $programs = DB::table('program')
                        ->where('AGENCY_ID', '=', $checkCompanyActive->AGENCY_ID)
                        ->where('PROGRAM_TYPE_ID', '=', '2')
                        ->orderBy('PROGRAM_ID', 'DESC')->paginate(10);
        return view('manasek.showUmraprograms')->with('allprograms', $programs);
    }

    public function programdelete(Request $request, $id, $activityID = 1) {
        $checkProgPublished = DB::table('program')
                ->where('PROGRAM_ID', '=', $id)
                ->first();
        if ($checkProgPublished->PUBLISH_PROGRAM == '0') {
            $branchdelete = DB::table('program')
                    ->where('PROGRAM_ID', '=', $id)
                    ->delete();
            $request->session()->flash('alert-success', trans('programm.deleteSuccess'));
        } else {
            $request->session()->flash('alert-danger', trans('programm.deleteNotAllowed'));
        }

        return redirect('/company/showHajProg/' . $activityID);
    }

    public function addHajProgStepOne(Request $request, $activityID = 1) {
        $rules = [
            'programName' => 'required',
            'travelMethod' => 'required',
            'programLevel' => 'required',
            'containtiket' => 'required',
            'containVisa' => 'required',
            'travelDate' => 'required|date|after:' . Carbon::now(),
            'returnDate' => 'required|date|after:travelDate',
            'gateDiscount' => 'numeric|min:0|max:99'
        ];
        $nicenames = [
            'programName' => trans('programm.programName'),
            'travelMethod' => trans('programm.travelMethod'),
            'programLevel' => trans('programm.programLevel'),
            'containtiket' => trans('programm.containtiket'),
            'containVisa' => trans('programm.containVisa'),
            'travelDate' => trans('programm.travelDate'),
            'returnDate' => trans('programm.returnDate'),
            'gateDiscount' => trans('programm.gateDiscount'),
        ];

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
            $branchInsert = DB::table('program')
                    ->insertGetId([
                'AGENCY_ID' => $checkCompanyActive->AGENCY_ID,
                'PROGRAM_NAME' => $request->input('programName'),
                'PROGRAM_TYPE_ID' => $activityID,
                'SEASON_ID' => $request->input('season'),
                'TRAVEL_METHOD_ID' => $request->input('travelMethod'),
                'PROGRAM_LEVEL_ID' => $request->input('programLevel'),
                'TICKET_FEES_INCLUDED' => $request->input('containtiket'),
                'VISA_FEES_INCLUDED' => $request->input('containVisa'),
                'TRAVEL_G_DATE' => $request->input('travelDate'),
                'RETURN_G_DATE' => $request->input('returnDate'),
                'PORTAL_PAYMENT_DISCOUNT' => $request->input('gateDiscount'),
                'INSTALLMENT' => $request->input('takseetAllowed'),
                'INCREASE_RYAL' => $request->input('ryalExchangeRate'),
                'INCREASE_TICKET' => $request->input('ryalExchangeRate'),
                'STEP_DATA_COMPLETE' => '1'
            ]);
            $request->session()->flash('alert-success', trans('programm.stepOneAddedSucces'));
            return redirect('/company/addhajprog/steptwo/' . $branchInsert . "/" . $activityID);
        }
    }

    public function addHajProgSteptwo(Request $request, $id, $activityID = 1) {
        $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
        if ($checkCompanyActive->ACTIVE_FLAG == 1) {
            $checkOldProg = DB::table('program_transportation')
                    ->join('program', 'program_transportation.PROGRAM_ID', '=', 'program.PROGRAM_ID')
                    ->where('program_transportation.PROGRAM_ID', '=', $id)
                    ->first();
            return view('manasek.addHajProgSteptwo')
                            ->with('active', 'yes')
                            ->with('oldprog', $checkOldProg);
        } else {
            return view('manasek.addHajProgSteptwo')->with('active', 'none');
        }
    }

    public function editprogstepOne(Request $request, $id, $activityID = 1) {
        $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
        if ($checkCompanyActive->ACTIVE_FLAG == 1) {
            $oldprog = DB::table('program')
                    ->where('PROGRAM_ID', '=', $id)
                    ->first();
            $lkp_travel_method = DB::table('lkp_travel_method')
                    ->orderBy('TRAVEL_METHOD_ID', 'ASC')
                    ->where('ACTIVE_FLAG', '=', '1')
                    ->get();
            $lkp_program_level = DB::table('lkp_program_level')
                    ->orderBy('PROGRAM_LEVEL_ID', 'ASC')
                    ->where('ACTIVE_FLAG', '=', '1')
                    ->get();
            $lkp_seasons = DB::table('lkp_season')
                    ->where('SEASON_TYPE', '=', $activityID)
                    ->where('ACTIVE_FLAG', '=', 1)
                    ->orderBy('SEASON_ID', 'ASC')
                    ->get();
            $lkp_activity_type = DB::table('lkp_activity_type')
                    ->where('ACTIVITY_TYPE_ID', '=', $activityID)
                    ->first();
            if ($oldprog->AGENCY_ID == $checkCompanyActive->AGENCY_ID) {
                return view('manasek.editprogstepOne')
                                ->with('active', 'yes')
                                ->with('oldprog', $oldprog)
                                ->with('lkp_travel_methods', $lkp_travel_method)
                                ->with('lkp_program_levels', $lkp_program_level)
                                ->with('lkp_activity_type', $lkp_activity_type)
                                ->with('lkp_seasons', $lkp_seasons);
            } else {
                return view('manasek.editprogstepOne')->with('active', 'none');
            }
        } else {
            return view('manasek.editprogstepOne')->with('active', 'none');
        }
    }

    public function editprogstepOnepost(Request $request, $id, $activityID = 1) {
        $rules = [
            'programName' => 'required',
            'season' => 'required',
            'travelMethod' => 'required',
            'programLevel' => 'required',
            'containtiket' => 'required',
            'containVisa' => 'required',
            'travelDate' => 'required|date|after:' . Carbon::now(),
            'returnDate' => 'required|date|after:travelDate',
            'gateDiscount' => 'numeric|min:0|max:99'
        ];
        $nicenames = [
            'programName' => trans('programm.programName'),
            'season' => trans('programm.season'),
            'travelMethod' => trans('programm.travelMethod'),
            'programLevel' => trans('programm.programLevel'),
            'containtiket' => trans('programm.containtiket'),
            'containVisa' => trans('programm.containVisa'),
            'travelDate' => trans('programm.travelDate'),
            'returnDate' => trans('programm.returnDate'),
            'gateDiscount' => trans('programm.gateDiscount'),
        ];

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
            $branchInsert = DB::table('program')
                    ->where('PROGRAM_ID', '=', $id)
                    ->update([
                'AGENCY_ID' => $checkCompanyActive->AGENCY_ID,
                'PROGRAM_NAME' => $request->input('programName'),
                'PROGRAM_TYPE_ID' => $activityID,
                'SEASON_ID' => $request->input('season'),
                'TRAVEL_METHOD_ID' => $request->input('travelMethod'),
                'PROGRAM_LEVEL_ID' => $request->input('programLevel'),
                'SEASON_ID' => $request->input('season'),
                'TICKET_FEES_INCLUDED' => $request->input('containtiket'),
                'VISA_FEES_INCLUDED' => $request->input('containVisa'),
                'TRAVEL_G_DATE' => $request->input('travelDate'),
                'RETURN_G_DATE' => $request->input('returnDate'),
                'PORTAL_PAYMENT_DISCOUNT' => $request->input('gateDiscount'),
                'INSTALLMENT' => $request->input('takseetAllowed'),
                'INCREASE_RYAL' => $request->input('ryalExchangeRate'),
                'INCREASE_TICKET' => $request->input('ryalExchangeRate')
            ]);
            $request->session()->flash('alert-success', trans('programm.stepOneEditSucces'));
            return redirect('/company/addhajprog/steptwo/' . $id . "/" . $activityID);
        }
    }

    public function steptwopost(Request $request, $id, $activityID = 1) {
        $rules = [
            'travelWayLine' => 'required',
        ];
        $nicenames = [
            'travelWayLine' => trans('programm.travelWayLine'),
        ];
        $validiator = Validator::make($request->all(), $rules);
        $validiator->setAttributenames($nicenames);
        if ($validiator->fails()) {
            return redirect()->back()
                            ->withErrors($validiator)
                            ->withInput();
        } else {
            $oldprog = DB::table('program_transportation')
                    ->where('PROGRAM_ID', '=', $id)
                    ->first();
            if ($oldprog) {
                $branchInsert = DB::table('program_transportation')
                        ->where('PROGRAM_ID', '=', $id)
                        ->update([
                    'travelWayLine' => $request->input('travelWayLine')
                ]);
            } else {
                $branchInsert = DB::table('program_transportation')
                        ->insert([
                    'PROGRAM_ID' => $id,
                    'travelWayLine' => $request->input('travelWayLine')
                ]);
            }

            $request->session()->flash('alert-success', trans('programm.steptwoEditSucces'));
            return redirect('/company/addhajprog/stepthree/' . $id . "/" . $activityID);
        }
    }

    public function addHajProgStepthree(Request $request, $id, $activityID = 1) {
        $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
        if ($checkCompanyActive->ACTIVE_FLAG == 1) {
            $oldprog = DB::table('program')
                    ->where('PROGRAM_ID', '=', $id)
                    ->first();
            if ($oldprog->AGENCY_ID == $checkCompanyActive->AGENCY_ID) {
                $oldprogtransportation = DB::table('program_transportation')
                        ->where('PROGRAM_ID', '=', $id)
                        ->first();

                $FROM_PORTs = DB::table('lkp_port')
                        ->where('TRAVEL_METHOD_ID', '=', $oldprog->TRAVEL_METHOD_ID)
                        ->where('ACTIVE_FLAG', '=', 1)
                        ->get();
                $lkp_airlines = DB::table('lkp_airline')
                        ->where('ACTIVE_FLAG', '=', 1)
                        ->get();
                return view('manasek.editprogstepthree')
                                ->with('active', 'yes')
                                ->with('oldprogtransportation', $oldprogtransportation)
                                ->with('oldprog', $oldprog)
                                ->with('lkp_airlines', $lkp_airlines)
                                ->with('FROM_PORTs', $FROM_PORTs);
            } else {
                return view('manasek.editprogstepthree')->with('active', 'none');
            }
        } else {
            return view('manasek.editprogstepthree')->with('active', 'none');
        }
    }

    public function stepthreepost(Request $request, $id, $activityID = 1) {
        $rules = [
            'FROM_PORT' => 'required',
            'TO_PORT' => 'required',
            'DIRECT_FLIGHT' => 'required',
            'FROM_PORTRE' => 'required',
            'TO_PORTRE' => 'required',
            'DIRECT_FLIGHTRE' => 'required',
        ];
        $nicenames = [
            'FROM_PORT' => trans('programm.FROM_PORT'),
            'TO_PORT' => trans('programm.TO_PORT'),
            'DIRECT_FLIGHT' => trans('programm.DIRECT_FLIGHT'),
            'FROM_PORTRE' => trans('programm.FROM_PORTRE'),
            'TO_PORTRE' => trans('programm.TO_PORTRE'),
            'DIRECT_FLIGHTRE' => trans('programm.DIRECT_FLIGHTRE'),
        ];
        $oldprogram = DB::table('program')
                ->where('PROGRAM_ID', '=', $id)
                ->first();
        if ($oldprogram->TRAVEL_METHOD_ID == 3) {
            $rules['AIRLINE_ID'] = 'required';
            $nicenames['AIRLINE_ID'] = trans('programm.AIRLINE_ID');
            $rules['AIRLINE_IDRE'] = 'required';
            $nicenames['AIRLINE_IDRE'] = trans('programm.AIRLINE_ID');
        }
        $validiator = Validator::make($request->all(), $rules);
        $validiator->setAttributenames($nicenames);
        if ($validiator->fails()) {
            return redirect()->back()
                            ->withErrors($validiator)
                            ->withInput();
        } else {
            $inserting = [
                'FROM_PORT_ID' => $request->input('FROM_PORT'),
                'TO_PORT_ID' => $request->input('TO_PORT'),
                'DIRECT_FLIGHT' => $request->input('DIRECT_FLIGHT'),
                'AIRLINE_ID' => $request->input('AIRLINE_ID'),
                'FROM_PORT_IDRE' => $request->input('FROM_PORTRE'),
                'TO_PORT_IDRE' => $request->input('TO_PORTRE'),
                'DIRECT_FLIGHTRE' => $request->input('DIRECT_FLIGHTRE'),
                'AIRLINE_IDRE' => $request->input('AIRLINE_IDRE'),
                'STEP_DATA_COMPLETE' => '1'
            ];
            $inserttravelWayLine = DB::table('program_transportation')
                    ->where('PROGRAM_ID', '=', $id)
                    ->update($inserting);
            $request->session()->flash('alert-success', trans('programm.stepthreeEditSucces'));
            return redirect('/company/addhajprog/stepfour/' . $id . "/" . 3 . "/" . $activityID);
        }
    }

    public function addHajProgStepFour(Request $request, $id, $cityId, $activityID = 1) {
        $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
        if ($checkCompanyActive->ACTIVE_FLAG == 1) {
            $hotels = DB::table('lkp_hotels')
                    ->where('ACTIVE_FLAG', '=', 1)
                    ->where('CITY_ID', '=', $cityId)
                    ->orderBy('HOTEL_ID', 'ASC')
                    ->get();
            $program_accommodations = DB::table('program_accommodation')
                    ->where('PROGRAM_ID', '=', $id)
                    ->where('CITY_ID', '=', $cityId)
                    ->orderBy('PROGRAM_ACCOMMODATION_ID', 'ASC')
                    ->first();
            $accommodation_grades = DB::table('lkp_accommodation_grade')
                    ->where('ACTIVE_FLAG', '=', 1)
                    ->orderBy('ACCOMMODATION_GRADE_ID', 'ASC')
                    ->get();
            $cityName = DB::table('lkp_city')
                    ->where('CITY_ID', '=', $cityId)
                    ->first();
            //print_r($hotels);
            return view('manasek.addHajProgStepFour')
                            ->with('active', 'yes')
                            ->with('hotels', $hotels)
                            ->with('program_accommodations', $program_accommodations)
                            ->with('cityName', $cityName)
                            ->with('cityId', $cityId)
                            ->with('accommodation_grades', $accommodation_grades);
        } else {
            return view('manasek.addHajProgStepFour')
                            ->with('active', 'none');
        }
    }

    public function stepfourpost(Request $request, $id, $cityId, $activityID = 1) {
        $rules = [
            'hotelName' => 'required',
            'WITH_BREAKFAST' => 'required',
            'WITH_LUNCH' => 'required',
            'WITH_DINNER' => 'required',
            'NUMBER_OF_NIGHTS' => 'required',
        ];
        $nicenames = [
            'hotelName' => trans('programm.hotelName'),
            'WITH_BREAKFAST' => trans('programm.WITH_BREAKFAST'),
            'WITH_LUNCH' => trans('programm.WITH_LUNCH'),
            'WITH_DINNER' => trans('programm.WITH_DINNER'),
            'NUMBER_OF_NIGHTS' => trans('programm.NUMBER_OF_NIGHTS'),
        ];

        $validiator = Validator::make($request->all(), $rules);
        $validiator->setAttributenames($nicenames);
        if ($validiator->fails()) {
            return redirect()->back()
                            ->withErrors($validiator)
                            ->withInput();
        } else {
            $inserting = [
                'PROGRAM_ID' => $id,
                'CITY_ID' => $cityId,
                'HOTEL_ID' => $request->input('hotelName'),
                'ACCOMMODATION_GRADE_ID' => $request->input('accommodation_grade'),
                'WITH_BREAKFAST' => $request->input('WITH_BREAKFAST'),
                'WITH_LUNCH' => $request->input('WITH_LUNCH'),
                'WITH_DINNER' => $request->input('WITH_DINNER'),
                'NUMBER_OF_NIGHTS' => $request->input('NUMBER_OF_NIGHTS'),
                'DISTANCE_FROM_HARAM' => $request->input('DISTANCE_FROM_HARAM'),
                'DISTANCE_FROM_jamarat' => $request->input('DISTANCE_FROM_jamarat'),
            ];
            $checkinsupd = DB::table('program_accommodation')
                    ->where('PROGRAM_ID', '=', $id)
                    ->where('CITY_ID', '=', $cityId)
                    ->first();
            if ($checkinsupd) {
                $dbquery = DB::table('program_accommodation')
                        ->where('PROGRAM_ID', '=', $id)
                        ->where('CITY_ID', '=', $cityId)
                        ->update($inserting);
            } else {
                $dbquery = DB::table('program_accommodation')
                        ->insert($inserting);
            }
            $request->session()->flash('alert-success', trans('programm.stepthreeEditSucces'));
            switch ($cityId) {
                case (3) :
                    return redirect('/company/addhajprog/stepfour/' . $id . '/' . 7 . "/" . $activityID);
                    break;
                case (7) :
                    if ($activityID == 1) {
                        return redirect('/company/addhajprog/stepfour/' . $id . '/' . 9 . "/" . $activityID);
                    } else {
                        return redirect('/company/addhajprog/stepfive/' . $id . "/" . $activityID);
                    }
                    break;
                case (9) :
                    if ($activityID == 1) {
                        return redirect('/company/addhajprog/stepfour/' . $id . '/' . 10 . "/" . $activityID);
                    } else {
                        return redirect('/company/addhajprog/stepfive/' . $id . "/" . $activityID);
                    }
                    break;
                case (10) :
                    if ($activityID == 1) {
                        return redirect('/company/addhajprog/stepfour/' . $id . '/' . 11 . "/" . $activityID);
                    } else {
                        return redirect('/company/addhajprog/stepfive/' . $id . "/" . $activityID);
                    }
                    break;
                case (11) :
                    return redirect('/company/addhajprog/stepfive/' . $id . "/" . $activityID);
                    break;
            }
        }
    }

    public function addHajProgStepFive(Request $request, $id, $activityID = 1) {
        $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
        if ($checkCompanyActive->ACTIVE_FLAG == 1) {
            $AGE_CATEGORY_IDS = DB::table('lkp_age_category')
                    ->where('ACTIVE_FLAG', '=', 1)
                    ->get();
            $program_price = DB::table('program_price')
                    ->where('PROGRAM_ID', '=', $id)
                    ->first();
            $CURRENCY_IDS = DB::table('lkp_currency')
                    ->where('ACTIVE_FLAG', '=', 1)
                    ->orderBy('CURRENCY_ID', 'ASC')
                    ->get();
            $oldprices = DB::table('program_price')
                    ->join('lkp_age_category', 'program_price.AGE_CATEGORY_ID', '=', 'lkp_age_category.AGE_CATEGORY_ID')
                    ->join('lkp_currency', 'program_price.CURRENCY_ID', '=', 'lkp_currency.CURRENCY_ID')
                    ->where('PROGRAM_ID', '=', $id)
                    ->orderBy('PROGRAM_PRICE_ID', 'DESC')
                    ->paginate(10);
            return view('manasek.addHajProgStepFive')
                            ->with('active', 'yes')
                            ->with('program_price', $program_price)
                            ->with('CURRENCY_IDS', $CURRENCY_IDS)
                            ->with('AGE_CATEGORY_IDS', $AGE_CATEGORY_IDS)
                            ->with('oldprices', $oldprices)
                            ->with('id', $id)
                            ->with('activityID', $activityID);
        } else {
            return view('manasek.addHajProgStepFive')
                            ->with('active', 'none');
        }
    }

    public function stepfivepost(Request $request, $id, $activityID = 1) {
        $rules = [
            'AGE_CATEGORY_ID' => 'required|numeric|min:1',
            'PERSON_PER_ROOM' => 'required',
            'CURRENCY_ID' => 'required',
            'PRICE' => 'required',
        ];
        $nicenames = [
            'AGE_CATEGORY_ID' => trans('programm.AGE_CATEGORY_ID'),
            'PERSON_PER_ROOM' => trans('programm.PERSON_PER_ROOM'),
            'CURRENCY_ID' => trans('company.currency'),
            'PRICE' => trans('programm.P_PRICE'),
        ];

        $validiator = Validator::make($request->all(), $rules);
        $validiator->setAttributenames($nicenames);
        if ($validiator->fails()) {
            if ($request->ajax()) {
                return response()->json(array(
                            'success' => false,
                            'errors' => $validiator->getMessageBag()->toArray()
                ));
            } else {
                return redirect()->back()
                                ->withErrors($validiator)
                                ->withInput();
            }
        } else {
            $inserting = [
                'PROGRAM_ID' => $id,
                'AGE_CATEGORY_ID' => $request->input('AGE_CATEGORY_ID'),
                'PERSON_PER_ROOM' => $request->input('PERSON_PER_ROOM'),
                'CURRENCY_ID' => $request->input('CURRENCY_ID'),
                'PRICE' => $request->input('PRICE'),
            ];
            $dbquery = DB::table('program_price')
                    ->insertGetId($inserting);
            if ($request->ajax()) {
                $oldprices = DB::table('program_price')
                        ->join('lkp_age_category', 'program_price.AGE_CATEGORY_ID', '=', 'lkp_age_category.AGE_CATEGORY_ID')
                        ->join('lkp_currency', 'program_price.CURRENCY_ID', '=', 'lkp_currency.CURRENCY_ID')
                        ->where('PROGRAM_PRICE_ID', '=', $dbquery)
                        ->first();
                return response()->json($oldprices);
            } else {
                $request->session()->flash('alert-success', trans('programm.stepthreeEditSucces'));
                return redirect('/company/addhajprog/stepfive/' . $id);
            }
        }
    }

    public function stepfivedelet(Request $request, $activityID = 1) {
        if ($request->ajax()) {

            $branchdelete = DB::table('program_price')
                    ->where('PROGRAM_PRICE_ID', '=', $request->input('id'))
                    ->delete();
            return response()->json('delet Done');
        }
    }

    public function stepfiveedite(Request $request, $id = NULL, $progID = NULL, $activityID = 1) {
        $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
        if ($checkCompanyActive->ACTIVE_FLAG == 1) {
            $AGE_CATEGORY_IDS = DB::table('lkp_age_category')
                    ->where('ACTIVE_FLAG', '=', 1)
                    ->get();
            $program_price = DB::table('program_price')
                    ->where('PROGRAM_PRICE_ID', '=', $id)
                    ->first();
            $CURRENCY_IDS = DB::table('lkp_currency')
                    ->where('ACTIVE_FLAG', '=', 1)
                    ->orderBy('CURRENCY_ID', 'ASC')
                    ->get();
            $oldprices = DB::table('program_price')
                    ->join('lkp_age_category', 'program_price.AGE_CATEGORY_ID', '=', 'lkp_age_category.AGE_CATEGORY_ID')
                    ->join('lkp_currency', 'program_price.CURRENCY_ID', '=', 'lkp_currency.CURRENCY_ID')
                    ->where('PROGRAM_ID', '=', $progID)
                    ->orderBy('PROGRAM_PRICE_ID', 'DESC')
                    ->paginate(10);
            return view('manasek.stepfiveedite')
                            ->with('active', 'yes')
                            ->with('program_price', $program_price)
                            ->with('CURRENCY_IDS', $CURRENCY_IDS)
                            ->with('AGE_CATEGORY_IDS', $AGE_CATEGORY_IDS)
                            ->with('oldprices', $oldprices)
                            ->with('id', $id)
                            ->with('progID', $progID)
                            ->with('activityID', $activityID);
        } else {
            return view('manasek.stepfiveedite')->with('active', 'none');
        }
    }

    public function stepfiveeditepost(Request $request, $id = NULL, $progID = NULL, $activityID = 1) {
        $rules = [
            'AGE_CATEGORY_ID' => 'required|numeric|min:1',
            'PERSON_PER_ROOM' => 'required',
            'CURRENCY_ID' => 'required',
            'PRICE' => 'required',
        ];
        $nicenames = [
            'AGE_CATEGORY_ID' => trans('programm.AGE_CATEGORY_ID'),
            'PERSON_PER_ROOM' => trans('programm.PERSON_PER_ROOM'),
            'CURRENCY_ID' => trans('company.currency'),
            'PRICE' => trans('programm.P_PRICE'),
        ];

        $validiator = Validator::make($request->all(), $rules);
        $validiator->setAttributenames($nicenames);
        if ($validiator->fails()) {
            return redirect()->back()
                            ->withErrors($validiator)
                            ->withInput();
        } else {
            $inserting = [
                'AGE_CATEGORY_ID' => $request->input('AGE_CATEGORY_ID'),
                'PERSON_PER_ROOM' => $request->input('PERSON_PER_ROOM'),
                'CURRENCY_ID' => $request->input('CURRENCY_ID'),
                'PRICE' => $request->input('PRICE'),
            ];
            $dbquery = DB::table('program_price')
                    ->where('PROGRAM_PRICE_ID', '=', $id)
                    ->update($inserting);
            $request->session()->flash('alert-success', trans('programm.stepfiveEditSucces'));
            return redirect('/company/program/prices/edit/' . $id . '/' . $progID);
        }
    }

    public function programpublish(Request $request, $status = 'yes', $id, $activityID = 1) {
        if ($status == 'yes') {
            $checkComplete = DB::table('program')
                    ->join('program_transportation', 'program.PROGRAM_ID', '=', 'program_transportation.PROGRAM_ID')
                    ->join('program_accommodation', 'program.PROGRAM_ID', '=', 'program_accommodation.PROGRAM_ID')
                    ->join('program_price', 'program.PROGRAM_ID', '=', 'program_price.PROGRAM_ID')
                    ->where('program.PROGRAM_ID', '=', $id)
                    ->first();
            if ($checkComplete) {
                $updatstatus = [
                    'PROGRAM_DATA_COMPLETE' => '1',
                    'PUBLISH_PROGRAM' => '1'
                ];
                $message = trans('programm.publishdone');
                $updating = DB::table('program')
                        ->where('PROGRAM_ID', '=', $id)
                        ->update($updatstatus);
                $request->session()->flash('alert-success', $message);
                return redirect('/company/showHajProg/' . $activityID);
            } else {
                $message = trans('programm.allstepsuncompleted');
                $request->session()->flash('alert-danger', $message);
                $stepOneCheck = DB::table('program')
                        ->where('PROGRAM_ID', '=', $id)
                        ->first();
                if ($stepOneCheck) {
                    if ($stepOneCheck->STEP_DATA_COMPLETE == 0) {
                        $errors[] = trans('programm.stepOneUnfinishedError');
                    }
                } else {
                    $errors[] = trans('programm.stepOneUnfinishedError');
                }
                ///
                $steptwoCheck = DB::table('program_transportation')
                        ->where('PROGRAM_ID', '=', $id)
                        ->first();
                if ($steptwoCheck) {
                    if ($steptwoCheck->STEP_DATA_COMPLETE == 0) {
                        $errors[] = trans('programm.stepthreeunfinished');
                    }
                } else {
                    $errors[] = trans('programm.steptwounfinished');
                }
                $stepfourCheck = DB::table('program_accommodation')
                        ->where('PROGRAM_ID', '=', $id)
                        ->first();
                if (!$stepfourCheck) {
                    $errors[] = trans('programm.stepfourunfinished');
                }
                $stepfiveCheck = DB::table('program_price')
                        ->where('PROGRAM_ID', '=', $id)
                        ->first();
                if (!$stepfiveCheck) {
                    $errors[] = trans('programm.stepfiveunfinished');
                }
                return redirect('/company/showHajProg/' . $activityID)->withErrors($errors);
            }
        } else {
            $updatstatus = ['PUBLISH_PROGRAM' => '0'];
            $message = trans('programm.unpublishdone');
            $updating = DB::table('program')
                    ->where('PROGRAM_ID', '=', $id)
                    ->update($updatstatus);
            $request->session()->flash('alert-success', $message);
            return redirect('/company/showHajProg/' . $activityID);
        }
    }

}

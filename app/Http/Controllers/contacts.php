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
 * Description of contacts
 *
 * @author mohamed
 */
class contacts extends Controller {

    //put your code here
    public function addcontactajax(Request $request) {
		if($request->ajax()) {
			if($request->has('agency_branch_id')) {
			   $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
			   $agency_id = $checkCompanyActive->AGENCY_ID;


	           $contactInsert = DB::table('agency_contact_data')
					   ->insertGetId([
						'AGENCY_ID' => $checkCompanyActive->AGENCY_ID,
						'AGENCY_BRANCH_ID' => $request->agency_branch_id,
						'CONTACT_METHOD_ID' => $request->select_prefcon,
						'CONTACT_DETAILS' => $request->prefconvalue
						]);
			   $request->session()->flash('alert-success', trans('company.contactsAddedSucces'));

			   $contacts = DB::table('agency_contact_data')
				->join('agency_branch', 'agency_contact_data.AGENCY_BRANCH_ID', '=', 'agency_branch.AGENCY_BRANCH_ID')
				->join('lkp_contact_method', 'agency_contact_data.CONTACT_METHOD_ID', '=', 'lkp_contact_method.CONTACT_METHOD_ID')
				->select('agency_contact_data.*', 'agency_branch.BRANCH_NAME', 'lkp_contact_method.CONTACT_METHOD_AR')
				->where('agency_contact_data.AGENCY_ID', '=', $agency_id)
				->where('agency_contact_data.AGENCY_BRANCH_ID', '=', $request->agency_branch_id)
				->get();

			   return response()->json($contacts);

			}
		}
	}
	/*--------------------------------------------------*/
    public function lst_contacts(Request $request) {
		if($request->ajax()) {
			if($request->has('agency_branch_id')) {
			   $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
			   $agency_id = $checkCompanyActive->AGENCY_ID;
			   
			   $contacts = DB::table('agency_contact_data')
				->join('agency_branch', 'agency_contact_data.AGENCY_BRANCH_ID', '=', 'agency_branch.AGENCY_BRANCH_ID')
				->join('lkp_contact_method', 'agency_contact_data.CONTACT_METHOD_ID', '=', 'lkp_contact_method.CONTACT_METHOD_ID')
				->select('agency_contact_data.*', 'agency_branch.BRANCH_NAME', 'lkp_contact_method.CONTACT_METHOD_AR')
				->where('agency_contact_data.AGENCY_ID', '=', $agency_id)
				->where('agency_contact_data.AGENCY_BRANCH_ID', '=', $request->agency_branch_id)
				->get();
			}
			return response()->json($contacts);
		}
	}
	/*--------------------------------------------------*/

    public function addcontact(Request $request) {
        $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
        if ($checkCompanyActive->ACTIVE_FLAG == 1) {
            $lkp_contact_method = DB::table('lkp_contact_method')
                    ->orderBy('CONTACT_METHOD_ID', 'ASC')
                    ->where('ACTIVE_FLAG', '=', '1')
                    ->get();
			$lst_contact_method =[];
			foreach($lkp_contact_method as $row){
				$lst_contact_method[$row->CONTACT_METHOD_ID]= $row->CONTACT_METHOD_AR;
			}
			$branches = DB::table('agency_branch')
                        ->where('AGENCY_ID', '=', $checkCompanyActive->AGENCY_ID)
						->get();

			$lst_agency_branch =[];
			foreach($branches as $row){
				$lst_agency_branch[$row->AGENCY_BRANCH_ID]= $row->BRANCH_NAME;
			}
            return view('manasek.addcontact')
                            ->with('active', 'yes')
                            ->with('companyName', $checkCompanyActive->AGENCY_NAME)
                            ->with('lst_branches', $lst_agency_branch) 
                            ->with('lst_contact_method', $lst_contact_method);
        } else {
            return view('manasek.addcontact')->with('active', 'none');
        }
    }

    public function addcontactPost(Request $request) {
        $rules = [
            'prefcon' => 'required',
            'prefconValue' => 'required',
            'agency_branch_id' => 'required'
        ];

        $nicenames = [
            'contactName' => trans('company.contactName'),
            'prefconValue' => trans('company.prefconValue'),
            'agency_branch_id' => trans('company.agency_branch'),
            'address' => trans('company.address'),
            'prefcon' => trans('company.prefcon'),
        ];

        if ($request->input('prefcon') == trans('company.companyEmail')) {
            $rules['contact_details'] = 'required|email';
            $nicenames['contact_details'] = trans('company.contact_details');
        } elseif ($request->input('prefcon') == trans('company.phone')) {
            $rules['contact_details'] = array('required', 'regex:/^(\+|00)[1-9]{1,3}(\.|\s|-)?([0-9]{1,5}(\.|\s|-)?){1,3}$/');
            $nicenames['contact_details'] = trans('company.prefconon');
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
            $contactInsert = DB::table('agency_contact_data')
                    ->insertGetId([
                'AGENCY_ID' => $checkCompanyActive->AGENCY_ID,
                'AGENCY_BRANCH_ID' => $request->agency_branch_id,
                'CONTACT_METHOD_ID' => $request->prefcon,
                'CONTACT_DETAILS' => $request->prefconValue
            ]);
            if ($contactInsert) {

				$contacts = DB::table('agency_contact_data')
				->join('agency_branch', 'agency_contact_data.AGENCY_BRANCH_ID', '=', 'agency_branch.AGENCY_BRANCH_ID')
				->join('lkp_contact_method', 'agency_contact_data.CONTACT_METHOD_ID', '=', 'lkp_contact_method.CONTACT_METHOD_ID')
				->select('agency_contact_data.*', 'agency_branch.BRANCH_NAME', 'lkp_contact_method.CONTACT_METHOD_AR')
				->where('agency_contact_data.AGENCY_ID', '=', $checkCompanyActive->AGENCY_ID)
				->where('agency_contact_data.AGENCY_BRANCH_ID', '=', $request->agency_branch_id)
				->get();


                $request->session()->flash('alert-success', trans('company.contactsAddedSucces'));
				
				$lkp_contact_method = DB::table('lkp_contact_method')
                    ->orderBy('CONTACT_METHOD_ID', 'ASC')
                    ->where('ACTIVE_FLAG', '=', '1')
                    ->get();
				$lst_contact_method =[];
				foreach($lkp_contact_method as $row){
					$lst_contact_method[$row->CONTACT_METHOD_ID]= $row->CONTACT_METHOD_AR;
				}
				$branches = DB::table('agency_branch')
							->where('AGENCY_ID', '=', $checkCompanyActive->AGENCY_ID)
							->get();

				$lst_agency_branch =[];
				foreach($branches as $row){
					$lst_agency_branch[$row->AGENCY_BRANCH_ID]= $row->BRANCH_NAME;
				}


				$contact = DB::table('agency_contact_data')
						->where('AGENCY_CONTACT_DATA_ID', '=', $contactInsert)
						->first();

				return view('manasek.addcontact')
                            ->with('active', 'yes')
                            ->with('companyName', $checkCompanyActive->AGENCY_NAME)
                            ->with('lst_branches', $lst_agency_branch) 
                            ->with('contact', $contact) 
                            ->with('lst_contacts', $contacts) 
                            ->with('lst_contact_method', $lst_contact_method);

            }
        }
    }

    public function showcontacts(Request $request) {
        

		$checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
        $branches = DB::table('agency_branch')
                        ->where('AGENCY_ID', '=', $checkCompanyActive->AGENCY_ID)
                        ->orderBy('AGENCY_BRANCH_ID', 'ASC')->get();
        return view('manasek.showcontacts')->with('allbranches', $branches);


    }

    public function contactDesc($id, Request $request) {
        $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
        $contacts = DB::table('agency_contact')
                ->where('AGENCY_BRANCH_ID', '=', $id)
                ->first();
        $contactCity = DB::table('lkp_city')
                ->where('CITY_ID', '=', $contacts->CITY_ID)
                ->first();
        $contactArea = DB::table('lkp_area')
                ->where('AREA_ID', '=', $contacts->AREA_ID)
                ->first();
        if ($checkCompanyActive->ACTIVE_FLAG == 1) {
            return view('manasek.contactDesc')
                            ->with('contacts', $contacts)
                            ->with('contactCity', $contactCity)
                            ->with('contactArea', $contactArea)
                            ->with('active', 'yes')
                            ->with('companyName', $checkCompanyActive->AGENCY_NAME)
            ;
        } else {
            return view('manasek.addcontact')->with('active', 'none');
        }
    }

    public function contactdelete($id) {
        $contactdelete = DB::table('agency_contact')
                ->where('AGENCY_BRANCH_ID', '=', $id)
                ->delete();
        return redirect('/company/showcontacts');
    }

    public function contactedit($id, Request $request) {
        $checkCompanyActive = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();

        if ($checkCompanyActive->ACTIVE_FLAG == 1) {
            $lkp_contact_method = DB::table('lkp_contact_method')
                    ->orderBy('CONTACT_METHOD_ID', 'ASC')
                    ->where('ACTIVE_FLAG', '=', '1')
                    ->get();
			$lst_contact_method =[];
			foreach($lkp_contact_method as $row){
				$lst_contact_method[$row->CONTACT_METHOD_ID]= $row->CONTACT_METHOD_AR;
			}
			$branche = DB::table('agency_branch')
                        ->where('AGENCY_BRANCH_ID', '=',  $id)
                    ->first();


			$agency_id = $checkCompanyActive->AGENCY_ID;

			   $contacts = DB::table('agency_contact_data')
				->join('agency_branch', 'agency_contact_data.AGENCY_BRANCH_ID', '=', 'agency_branch.AGENCY_BRANCH_ID')
				->join('lkp_contact_method', 'agency_contact_data.CONTACT_METHOD_ID', '=', 'lkp_contact_method.CONTACT_METHOD_ID')
				->select('agency_contact_data.*', 'agency_branch.BRANCH_NAME', 'lkp_contact_method.CONTACT_METHOD_AR')
				->where('agency_contact_data.AGENCY_ID', '=', $agency_id)
				->where('agency_contact_data.AGENCY_BRANCH_ID', '=', $id)
				->get();


            return view('manasek.editcontact')
                            ->with('active', 'yes')
                            ->with('companyName', $checkCompanyActive->AGENCY_NAME)
                            ->with('branche', $branche) 
                            ->with('contacts', $contacts) 
                            ->with('lst_contact_method', $lst_contact_method);
        } else {
            return view('manasek.editcontact')->with('active', 'none');
        }
    }

    public function update_contact( Request $request) {
	
		if($request->ajax()) {
            $contactInsert = DB::table('agency_contact_data')
                    ->where('AGENCY_CONTACT_DATA_ID', '=', $request->item_id)
                    ->update([
                'CONTACT_DETAILS' => $request->item_value
            ]);

			   return response()->json("ok");
		}
	}
    public function contacteditpost($id, Request $request) {
	
		$rules = [
            'prefcon' => 'required',
            'prefconValue' => 'required',
            'agency_branch_id' => 'required'
        ];

        $nicenames = [
            'contactName' => trans('company.contactName'),
            'prefconValue' => trans('company.prefconValue'),
            'agency_branch_id' => trans('company.agency_branch'),
            'prefcon' => trans('company.prefcon'),
        ];

        if ($request->prefcon == '4') {
            $rules['prefconValue'] = 'required|email';
            $nicenames['prefconValue'] = trans('company.contact_details_email');
        } elseif ($request->prefcon == '1') {
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
            $contactInsert = DB::table('agency_contact_data')
                    ->where('AGENCY_CONTACT_DATA_ID', '=', $id)
                    ->update([
                'AGENCY_BRANCH_ID' => $request->agency_branch_id,
                'CONTACT_METHOD_ID' => $request->prefcon,
                'CONTACT_DETAILS' => $request->prefconValue
            ]);
            $request->session()->flash('alert-success', trans('company.contactsEditSucces'));
            return redirect('company/contact/edit/' . $id);
        }
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Name Spaces

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Mail;
use Carbon\Carbon;

/**
 * Description of companyController
 *
 * @author mohamed
 */
class companyController extends Controller {

    //put your code here
    public function Index() {
        return view('manasek.login');
    }

    public function store(Request $request) {
        //return "123";
        $rules = [
            'usname' => 'required',
            'password' => 'required|min:6|max:100',
        ];
        $nicenames = [
            'usname' => trans('company.usname'),
            'password' => trans('company.password'),
        ];
        $validiator = Validator::make($request->all(), $rules);
        $validiator->setAttributenames($nicenames);
        if ($validiator->fails()) {
            return redirect()->back()->withErrors($validiator);
        } else {
            $usname = $request->input('usname');
            $password = md5(crypt($request->input('password'), SHUMOOLSALT));
            //echo $usname . "<br>";
            //echo $password . "<br>";
            $getRecords = DB::table('front_larausers')->where('usname', $usname)
                    ->where('user_password', '=', $password)
                    ->where('ACTIVE_FLAG', '=', '1')
                    ->first();
            //print_r($getRecords); $getRecords;
            if ($getRecords) {
                $request->session()->put('companyID', $getRecords->id);
                //echo $request->session()->get('companyID');   
                return redirect('/company/dashboard');
            } else {
                $checkActive = DB::table('front_larausers')->where('usname', $usname)
                        ->where('user_password', '=', $password)
                        ->where('ACTIVE_FLAG', '=', '0')
                        ->get();
                $checkUsNameRecords = DB::table('front_larausers')->where('usname', $usname)
                        ->where('user_password', '<>', $password)
                        ->get();
                if ($checkActive) {
                    return redirect()->back()->withErrors(trans('messages.errors.1023'));
                } else if ($checkUsNameRecords) {
                    return redirect()->back()->withErrors(trans('messages.errors.1022'));
                } else {
                    return redirect()->back()->withErrors(trans('messages.errors.1024'));
                }
                //trans('messages.1022')
                return redirect()->back()->withErrors(trans('messages.errors.1022'));
            }
        }
    }

    public function companySignOut(Request $request) {
        $request->session()->forget('companyID');
        $request->session()->forget('companyType');
        return redirect('/company/login');
    }

    public function signup() {
        return View('manasek.company');
    }

    public function signuppost(Request $request) {
        $rules = [
			'usname' => 'required|unique:front_larausers|min:6|max:25',
            'email_address' => 'required|email|unique:front_larausers|max:255',
            'com_email2' => 'required|same:email_address',
            'user_password' => 'required|min:3|max:10',
            'password2' => 'required|same:user_password',
        ];
        $nicenames = [
			'usname' => trans('company.usname'),
            'email_address' => trans('company.companyEmail'),
            'com_email2' => trans('company.companyReEmail'),
            'user_password' => trans('company.password'),
            'password2' => trans('company.companyRePassword'),
        ];
        $validiator = Validator::make($request->all(), $rules);
        $validiator->setAttributenames($nicenames);
        if ($validiator->fails()) {
            return redirect()->back()
                            ->withErrors($validiator)
                            ->withInput($request->except('user_password'));
        } else {
            $userpassword = md5(crypt($request->input('user_password'), SHUMOOLSALT));
            $confirmation_code = csrf_token();
            $add = DB::table('front_larausers')->insert([
			'usname' => $request->input('usname'),
                'email_address' => $request->input('email_address'),
                'user_password' => $userpassword,
                'user_type' => '2',
                'created_at' => Carbon::now(),
                'remember_token' => $confirmation_code,
                    ]
            );
            $request->session()->flash('alert-success', trans('company.signupsuccess'));
			$data['usname'] = $request->input('usname');
            $data['email_address'] = $request->input('email_address');
            $data['subject'] = 'Verify Your Email Address';
            $dataforMail['useremail'] = $request->input('email_address');
            $dataforMail['confirmation_code'] = $confirmation_code;
            Mail::send('email.welcome', $dataforMail, function ($message) use ($data) {
                $message->from(EMAILFROM, EMAILFROMNAME);
                $message->to($data['email_address']);
                $subject = $data['subject'];
                $message->subject($subject);
                $message->getSwiftMessage();
            });

            return redirect('/company/login');
        }
    }

    public function verify(Request $request, $email = NULL, $code = NULL) {
        $rules = [
            'email' => 'required|email',
            'code' => 'required',
        ];
        $nicenames = [
            'email' => trans('company.companyEmail'),
            'code' => trans('company.confirmCode')
        ];
        if ($code == NULL && $email == NULL) {
            $email = $request->input('email');
            $code = $request->input('code');
        }
        $inputtoValid = [
            'email' => $email,
            'code' => $code
        ];
        $validiator = Validator::make($inputtoValid, $rules);
        $validiator->setAttributenames($nicenames);
        if ($validiator->fails()) {
            return view('manasek.confirmCode')->withErrors($validiator);
        } else {

            $confSelect = DB::table('front_larausers')
                    ->where('remember_token', '=', $code)
                    ->where('email_address', '=', $email)
                    ->get();
            if ($confSelect) {
                $confirmMailUpdate = DB::table('front_larausers')
                        ->where('email_address', '=', $email)
                        ->update(['ACTIVE_FLAG' => '1']);
                if ($confirmMailUpdate) {
                    $request->session()->flash('alert-success', trans('company.verifySucc'));
                    return redirect('/company/login');
                } else {
                    return view('manasek.confirmCode')->withErrors(trans('company.updateError'));
                }
            } else {
                return view('manasek.confirmCode')->withErrors(trans('company.confirmCodeError'));
            }
        }
    }

    public function verifypost(Request $request) {
        $rules = [
            'email' => 'required|email',
            'code' => 'required',
        ];
        $nicenames = [
            'email' => trans('company.companyEmail'),
            'code' => trans('company.confirmCode')
        ];
        $validiator = Validator::make($request->all(), $rules);
        $validiator->setAttributenames($nicenames);
        if ($validiator->fails()) {
            return view('manasek.confirmCode')->withErrors($validiator);
        } else {

            $confSelect = DB::table('front_larausers')
                    ->where('remember_token', '=', $request->input('code'))
                    ->where('email_address', '=', $request->input('email'))
                    ->get();
            if ($confSelect) {
                $confirmMailUpdate = DB::table('front_larausers')
                        ->where('email_address', '=', $request->input('email'))
                        ->update(['ACTIVE_FLAG' => '1']);
                if ($confirmMailUpdate) {
                    $request->session()->flash('alert-success', trans('company.verifySucc'));
                    return redirect('/company/login');
                }
            } else {
                return view('manasek.confirmCode')->withErrors(trans('company.confirmCodeError'));
            }
        }
    }

}

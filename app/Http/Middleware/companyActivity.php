<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests;
use DB;
class companyActivity {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $companyActivity;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $companyActivity) {
        $this->companyActivity = $companyActivity;
    }

    public function handle($request, Closure $next) {
        //$request->session()->put('company', 'Mohamed');
        $agencyID = DB::table('agency')
                ->where('front_user_id', '=', $request->session()->get('companyID'))
                ->first();
                $checkProgPublished = DB::table('agency_activity')
                ->where('AGENCY_ID', '=', $agencyID->AGENCY_ID)
                 ->where('ACTIVITY_ID', '=', $request->activityID)       
                ->first();
        if (!$checkProgPublished) {
            //return redirect('/company/login');
           $request->session()->flash('alert-danger', trans('programm.hajActivityNotAlloweds'));
            return redirect('/company/profileEdit');
        }

        return $next($request);
    }

}

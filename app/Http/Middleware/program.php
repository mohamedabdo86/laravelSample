<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests;
use DB;
class program {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $program;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $program) {
        $this->program = $program;
    }

    public function handle($request, Closure $next) {
        //$request->session()->put('company', 'Mohamed');
                $checkProgPublished = DB::table('program')
                ->where('PROGRAM_ID', '=', $request->id)
                ->first();
        if ($checkProgPublished->PUBLISH_PROGRAM == $request->id) {
            //return redirect('/company/login');
           $request->session()->flash('alert-danger', trans('programm.editNotAllowed'));
            return redirect('/company/showHajProg');
        }

        return $next($request);
    }

}

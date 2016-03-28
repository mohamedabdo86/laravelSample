<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class company {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $company;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $company) {
        $this->company = $company;
    }

    public function handle($request, Closure $next) {
        //$request->session()->put('company', 'Mohamed');

        if (!$request->session()->has('companyID')) {
            //return redirect('/company/login');
            return redirect('/company/login');
        }

        return $next($request);
    }

}

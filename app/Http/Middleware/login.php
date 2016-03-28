<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class login
{
    protected $Login;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $Login)
    {
        $this->Login = $Login;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //$request->session()->forget('company');
        if ($request->session()->has('companyID')) {
            //
            return redirect ('/company/dashboard');
        }
        /*if ($request->session()->has('company')){
            redirect('/dashboard');
        }else {
            redirect('/mohamed');
        }*/
        return $next($request);
    }
}

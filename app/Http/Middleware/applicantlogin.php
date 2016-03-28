<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class company
{
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
    public function __construct(Guard $company)
    {
        $this->company = $company;
    }

    public function handle($request, Closure $next)
    {
        //$request->session()->put('company', 'Mohamed');
        $request->session()->forget('company');
        if (!$request->session()->has('company')) {
            //
            return redirect('/login');
        }else {
            return redirect ('/dashboard');
        }

        return $next($request);
    }
}

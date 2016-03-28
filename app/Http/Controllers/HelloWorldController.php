<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 20/08/2015
 * Time: 07:59 ?
 */
namespace App\Http\Controllers;

class HelloWorldController extends Controller {
    public function __construct(){
        $this->middleware('guest');
    }
    public function index(){
        return view('helloworld');
    }
}
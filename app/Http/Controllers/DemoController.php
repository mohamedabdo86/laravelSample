<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 20/08/2015
 * Time: 08:37 ?
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

class DemoController extends   BaseController
{
    public $restful = true;
    public function get_index(){
        $title = 'laravel Page';
        $View = View::make('demo1.index'.array(
                'name'=>'laravel user',
                'age'=>'28',
                'location'=>'bangalore')
            )->with('title',$title);
        return $View;
    }
}
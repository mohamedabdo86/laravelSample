<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
define('SHUMOOLSALT', 'shumool');
define('EMAILFROMNAME', 'Manasek Online');
define("EMAILFROM", 'info@manasekonline.com');
Route::get('/', function() {

    return 'laravel.apples';
});
Route::resource('member', 'Atest');
//define('Company', 'company');
/* Route::group(['middleware' => 'App\Http\Middleware\login'],function(){
  Route::get('/login',function(){
  return 'Company Login Form';
  });
  }); */
Route::group(['middleware' => 'App\Http\Middleware\login'], function() {
    Route::get('/company/login', 'companyController@index');
    Route::get('/company/signup', 'companyController@signup');
    Route::post('/company/signup', 'companyController@signuppost');
    Route::post('/company/login', 'companyController@store');
    Route::get('/company/verify/{email}-{code}', 'companyController@verify');
    Route::post('/company/verify', 'companyController@verifypost');
});
/* Route::post('/company/login', [
  'middleware' => 'App\Http\Middleware\login',
  'uses' => 'companyController@store'
  ]); */

Route::get('/signout', 'companyController@companySignOut');
Route::get('/company/search', 'search@index');
Route::post('/company/search', 'search@getResult');
Route::group(['middleware' => 'App\Http\Middleware\company'], function() {
    // Route::get('/sessionCheck', );
    Route::post('/company/addcontact', 'contacts@addcontactPost');
    Route::post('/company/addcontactajax', 'contacts@addcontactajax');
    Route::get('/company/lst_contacts', 'contacts@lst_contacts');
    Route::post('/company/update_contact', 'contacts@update_contact');
    Route::get('/company/addcontact', 'contacts@addcontact');
    Route::get('/company/contact/edit/{id}', 'contacts@contactedit');
    Route::post('/company/contact/edit/{id}', 'contacts@contacteditpost');
    Route::get('/company/showcontacts', 'contacts@showcontacts');
    Route::get('/company/dashboard', 'companydashboard@Index');
    Route::post('/company/dashboard', 'companydashboard@uploadFiles');
    Route::get('/company/passwordEdit', 'companyprofile@passwordEdit');
    Route::post('/company/passwordEdit', 'companyprofile@passwordEditPost');
    Route::get('/company/profileEdit', 'companyprofile@profileEdit');
    Route::post('/company/profileEdit', 'companyprofile@profileEditPost');
    Route::post('/company/addbranch', 'branches@addbranchPost');
    Route::get('/company/addbranch', 'branches@addbranch');
    Route::get('/company/showbranches', 'branches@showbranches');
    Route::get('/company/branch/{id}', 'branches@branchDesc');
    Route::get('/company/branch/edit/{id}', 'branches@branchedit');
    Route::get('/company/branch/delete/{id}', 'branches@branchdelete');
    Route::post('/company/branch/edit/{id}', 'branches@brancheditpost');
    Route::group(['middleware' => 'App\Http\Middleware\companyActivity'], function() {
        Route::get('/company/addhajprog/{activityID?}', 'programs@addhajprog');
        Route::post('/company/addhajprog/{activityID?}', 'programs@addHajProgStepOne');
        Route::group(['middleware' => 'App\Http\Middleware\program'], function() {
            Route::get('/company/addhajprog/steptwo/{id}/{activityID?}', 'programs@addHajProgSteptwo');
            Route::post('/company/addhajprog/steptwo/{id}/{activityID?}', 'programs@steptwopost');
            Route::get('/company/addhajprog/stepthree/{id}/{activityID?}', 'programs@addHajProgStepthree');
            Route::post('/company/addhajprog/stepthree/{id}/{activityID?}', 'programs@stepthreepost');
            Route::get('/company/addhajprog/stepfour/{id}/{cityId?}/{activityID?}', 'programs@addHajProgStepFour');
            Route::post('/company/addhajprog/stepfour/{id}/{cityId?}/{activityID?}', 'programs@stepfourpost');
            Route::get('/company/addhajprog/stepfive/{id}/{activityID?}', 'programs@addHajProgStepFive');
            Route::post('/company/addhajprog/stepfive/{id}/{activityID?}', 'programs@stepfivepost');
            Route::get('/company/prog/edit/stepOne/{id}/{activityID?}', 'programs@editprogstepOne');
            Route::post('/company/prog/edit/stepOne/{id}/{activityID?}', 'programs@editprogstepOnepost');
        });
        Route::get('/company/showHajProg/{activityID?}', 'programs@showHajProg');
        Route::get('/company/showUmraprograms/{activityID?}', 'programs@showUmraprograms');
        Route::get('/company/prog/delete/{id}/{activityID?}', 'programs@programdelete');
        Route::get('/company/showprog/{id}/{activityID?}', 'programs@programview');
        Route::post('/company/addhajprog/stepfivedelet', 'programs@stepfivedelet');
        Route::get('company/program/prices/edit/{id?}/{progID?}/{activityID?}', 'programs@stepfiveedite');
        Route::post('company/program/prices/edit/{id?}/{progID?}/{activityID?}', 'programs@stepfiveeditepost');
        Route::get('/company/prog/publish/{status?}/{id?}/{activityID?}', 'programs@programpublish');
        Route::get('/company/viewreqprog/{activityID?}', 'reqPrograms@viewreqprog');
    });
});
//Route::resource(Company,'company');
	//use Illuminate\Http\Request;
	//$request->session()->put('apps', 'Mohamed');
/*
Route::pattern('name','[a-zA-Z]+');
Route::get('/', 'Atest@index');
Route::get('/createnewuser','Atest@create');
Route::put('/createnewuser','Atest@store');
Route::get('/edituser/{id?}','Atest@edit');
Route::put('/edituser/{id?}','Atest@update');
Route::get('/deleteuser/{id?}','Atest@destroy');

Route::get('/user/{name}',function($name){
    return $name;
});
*/
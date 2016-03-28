<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Validator;
class Atest extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $users = User::orderBy('id','desc')->paginate(2);
       // $users = DB::table('users')->orderBy('id','ASC')->take(4)-> get();
        //$user = User::find(1);
        $user = DB::table('users')->where('id','=','5')->first();
        return view('index')->with('allusers',$users)->with('oneUser',$user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('atest');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'email'=>'required|email|unique:users|max:255',
            'name' => 'required',
            'password' => 'required|min:3',
        ];
        $nicenames = [
        'email'=>'البريد الالكتروني',
        'name'=>'اسم المستخدم',
        'password'=>'كلمة المرور'
        ];
        $validiator =  Validator::make($request->all(),$rules );
        $validiator->setAttributenames($nicenames);
        if ($validiator->fails()) {
               //return redirect()->back()->withErrors($validiator);
          if ($request->ajax()){
          return  response()->json('no inputs');
        }
        }else {
            /*$add = DB::table('users')->insert([
                    'email'=>$request->input('email'),
                    'name'=>$request->input('name'),
                    'password'=>bcrypt($request->input('password')),
                ]

            );*/
            $add = new User();
            $add->email = $request->input('email');
            $add->name = $request->input('name');
            $add->password = bcrypt($request->input('password'));
            $add->save();
            if ($request->ajax()){
                return response()->json($add);
            }else {
            return redirect('/member');
            }
        //
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        return view('edit')->with('edit',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        $update = User::find($id);
        $update->name = $request->input('username');
        if ($request->has('password')) {
            $update->password = bcrypt($request->input('password'));
        }
        $update->email=$request->input('email');
        $update->save();
        return redirect('/member');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        //
        return redirect('/member');
    }
}

{!! Form::open(['method'=>'PATCH','url' => 'member/'.$edit->id]) !!}
{!! Form::label('username','User Name') !!}
{!! Form::text('username',$edit->name) !!}
<br>
{!! Form::label('password','Password') !!}
{!! Form::password('password') !!}
<br>
{!! Form::label('email','E-Mail') !!}
{!! Form::text('email',$edit->email) !!}
<br>
{!! Form::submit('Update') !!}

{!! Form::close() !!}
<br>
{!! link_to('/','Back Home') !!}
<?php /*<form method='post'>
    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
    <div>
        <label>User Name : <input type='text' name='username' value="{{$edit->name}}"></label>
    </div>
    <div>
        <label>Password : <input type='password' name='password' value="{{$edit->password}}"></label>
    </div>
    <div>
        <label>E-mail : <input type='text' name='email' value="{{$edit->email}}"></label>
    </div>
    <input type='submit' value='Update' name='send'>
*/?>
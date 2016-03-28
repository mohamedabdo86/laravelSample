
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
@if(count($errors) > 0)
<div class='alert alert-danger'>
<ul>
    @foreach ($errors->all() as $error)
    <li>
        {{$error}}
    </li>

    @endforeach

</ul></div>
@endif
{!! Form::open(['method'=>'POST','route' => 'member.store']) !!}
{!! Form::label('name','User Name') !!}
{!! Form::text('name') !!}
<br>
{!! Form::label('password','Password') !!}
{!! Form::password('password') !!}
<br>
{!! Form::label('email','E-Mail') !!}
{!! Form::text('email') !!}
<br>
{!! Form::submit('Create Account') !!}

{!! Form::close() !!}
<br>
{!! link_to('/','Back Home') !!}
<?php /*<form method='post'>
    <input type='hidden' name='_method' value='PUt' >
    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
    <div>
        <label>User Name : <input type='text' name='username'></label>
    </div>
    <div>
        <label>Password : <input type='password' name='password'></label>
    </div>
    <div>
        <label>E-mail : <input type='text' name='email'></label>
    </div>
    <input type='submit' value='Create Account' name='send'>
 */
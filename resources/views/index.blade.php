<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
{!! link_to('member/create','Create Account') !!}
<script type="text/javascript">
$(document).ready(function(){
	$('.addaccount').on('click',function(){
		var username = $('.username').val();
		var password = $('.password').val();
		var email = $('.email').val();
		var token = '{!! csrf_token() !!}';
		$.ajax({
			url:'{{URL::route("member.store")}}',
			dataType:'json',
			type:'post',
			data:{name:username,password:password,email:email,_token:token},
			beforeSend:function(){

			},success:function(data){
				//alert(data);
				$('.listitems').prepend('<li>'+data['name']+'</li>');
			},error:function(data){
				alert(data);
			}


		});
	});

});
</script>
<div class='clearfix'></div>
<div class='col-md-4'>
username :{!!Form::text('name','',['class'=>'form-control username'])!!}
{!!Form::password('password',['class'=>'form-control password'])!!}
{!!Form::text('email','',['class'=>'form-control email'])!!}
{!! Form::submit('create New Accont',['class'=>'btn btn-success addaccount']) !!}
</div>
<div class='clearfix'></div>

<hr>
<ul class='listitems'>
    @foreach($allusers as $user)
    <li>{{$user->id}} - {{$user->name}} -
        {!! link_to('/member/'.$user->id.'/edit','Edit') !!} -
        {!! Form::open(['method'=>'delete','url'=>'member/'.$user->id,'style'=>'display:inline;']) !!}
        {!! Form::submit('Delete User') !!}
        {!! Form::close() !!}
    </li>
        @endforeach
</ul>

<hr>
{!! $allusers->render() !!}
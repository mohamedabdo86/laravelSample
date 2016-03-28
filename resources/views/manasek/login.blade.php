@include ('manasek.header')
<div class="container">
    <h1 class="page-title"></h1>
</div>

<div class="container">
    <div class="row">
        <?php //require_once "left.php"; ?>
        <div class="col-md-9">

            <h2>{{trans('company.companyLogin')}}</h2>
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
                @endforeach
            </div> <!-- end .flash-message -->
            <div class="row row-wrap">

                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-12">
                            @if (count($errors)>0)
                            <div class='alert alert-danger'>
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                @foreach ($errors->all() as $error) 
                                {!!$error!!}</li>
                                @endforeach
                            </div>
                            @endif
                            {!! Form::open(['method'=>'POST','class'=>'form-horizontal',
                                'id'=>'attributeForm', 
                                'data-bv-message'=>'This value is not valid',
'data-bv-feedbackicons-invalid'=>'glyphicon glyphicon-remove',
'data-bv-feedbackicons-validating'=>'glyphicon glyphicon-refresh'
]) !!}

                            <div class="form-group">
                                <label class="col-md-2 control-label" >{{trans('company.usname')}}</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" name="usname" placeholder="{{trans('company.usname')}}" type="text"  data-bv-notempty="true"
                data-bv-notempty-message="{{trans('validation.required', ['attribute' => trans('company.usname')])}}"/>
                                    @if(count($errors) > 0) {{$errors->first('usname')}}@endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" >{{trans('company.password')}}</label>
                                <div class="col-md-4">
                                    <input class="form-control" name="password" placeholder="{{trans('company.password')}}" type="password"  data-bv-notempty="true"
                data-bv-notempty-message="{{trans('validation.required', ['attribute' => trans('company.password')])}}"   />
                                    @if(count($errors) > 0) {{$errors->first('password')}}@endif
                                </div>

                            </div>

                            <input class="btn btn-primary" type="submit" name="loginsubmit" value="{{trans('company.companyLogin')}}" />
                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>


    @include ('manasek.footer')

      {!!@script('js/bootstrapValidator.js')!!}
        <script language="javascript">
$('#attributeForm').bootstrapValidator();
</script>

@include ('manasek.header')
        <div class="container">
            <h2 class="page-title">{{trans('company.profiletitle')}}</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include ('manasek.sidebar')
                </div>
                <div class="col-md-9">
                    <p>{{trans('company.passwordEditDesc')}}</p>
                       <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
    
  </div> <!-- end .flash-message -->
  @if (count($errors)>0)
                                    <div class='alert alert-danger'>
                                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                            @foreach ($errors->all() as $error) 
                                            {!!$error!!}</li>
                                            @endforeach
                                    </div>
                                    @endif
                    <div class="gap gap-small"></div>
                    <hr>
                    <h2>{{trans('company.passwordEdit')}}</h2>
                    <div class="row row-wrap">
{!! Form::open(['method'=>'POST','class'=>'form-horizontal',
                                 'data-bv-message'=>'This value is not valid',

                             'id'=>'attributeForm']) !!}
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('company.oldpassword')}}</label>
                                          <div class="col-md-6">
                                        <input class="form-control input-md" name="oldpassword" placeholder="{{trans('company.oldpassword')}}" type="password" 
               	data-bv-notempty="true"
                data-bv-notempty-message="{{trans('validation.required', ['attribute' => trans('company.oldpassword')])}}"
 />
                                           <label class="errorform"> @if(count($errors) > 0) {{$errors->first('oldpassword')}}@endif</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('company.newpassword')}}</label>
                                        <div class="col-md-6">
                                        	<input class="form-control" name="newpassword" placeholder="{{trans('company.newpassword')}}" type="password"
                data-bv-notempty="true"
                data-bv-notempty-message="{{trans('validation.required', ['attribute' => trans('company.newpassword')])}}"
                data-bv-identical="true"
                data-bv-identical-field="newpasswordre"
                data-bv-identical-message="{{trans('validation.same', ['attribute' => trans('company.newpassword'),'other'=>trans('company.newpasswordre')])}}"


 />
                                            <label class="errorform">@if(count($errors) > 0) {{$errors->first('newpassword')}}@endif</label>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('company.newpasswordre')}}</label>
                                        <div class="col-md-6">
                                        	<input class="form-control" name="newpasswordre" placeholder="{{trans('company.newpasswordre')}}" type="password"                data-bv-notempty="true"
                data-bv-notempty-message="{{trans('validation.required', ['attribute' => trans('company.newpasswordre')])}}"
                data-bv-identical="true"
                data-bv-identical-field="newpassword"
                data-bv-identical-message="{{trans('validation.same', ['attribute' => trans('company.newpasswordre'),'other'=>trans('company.newpassword')])}}"
 />
                                          <label class="errorform">  @if(count($errors) > 0) {{$errors->first('newpasswordre')}}@endif</label>
                                        </div>
                                    </div>
                                    
                                <input class="btn btn-primary" type="submit" name="passsubmit" value="{{trans('company.passwordEdit')}}" />
                                {!! Form::close() !!}
                        
                    </div>

                </div>
            </div>
        </div>


@include ('manasek.footer')
      {!!@script('js/bootstrapValidator.js')!!}
        <script language="javascript">
$('#attributeForm').bootstrapValidator();
</script>
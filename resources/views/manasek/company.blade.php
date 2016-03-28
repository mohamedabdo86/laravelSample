@include ('manasek.header')
        <div class="container">
            <h1 class="page-title"></h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h2>{{ trans('company.companySignUp') }}</h2>
                    <div class="row row-wrap">
                        
                        <div class="col-md-12">
                        
                            <div class="row">
                                <div class="col-md-12">

                                {!! Form::open(['method'=>'POST','class'=>'form-horizontal',
                                 'data-bv-message'=>'This value is not valid',

                             'id'=>'attributeForm']) !!}

                            <div class="form-group">
                                <label class="col-md-2 control-label" >{{trans('company.usname')}}</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" name="usname" placeholder="{{trans('company.usname')}}" type="text"       data-bv-notempty="true"
                data-bv-message="{{trans('validation.required', ['attribute' => trans('company.usname')])}}"

                data-bv-notempty-message="{{trans('validation.required', ['attribute' => trans('company.usname')])}}"
/>
                                    @if(count($errors) > 0) {{$errors->first('usname')}}@endif
                                </div>
                            </div>
                                    <div class="form-group">
                                    <label class="col-md-2 control-label">{{ trans('company.companyEmail') }}<span class="errorform">*</span></label>
                                        <div class="col-md-4"> 
                                        <input class="form-control" name="email_address" placeholder="{{ trans('company.companyEmail') }}" type="email" value="{{Request::old('email_address')}}"
data-bv-notempty="true"
data-bv-notempty-message="{{trans('validation.required', ['attribute' => trans('company.companyEmail')])}}"
data-bv-emailaddress-message="{{trans('validation.email', ['attribute' => trans('company.companyEmail')])}}" data-bv-identical="true"
                data-bv-identical-field="com_email2"
                data-bv-identical-message="{{trans('validation.same', ['attribute' => trans('company.companyEmail'),'other'=>trans('company.companyReEmail')])}}"  />
                                            <label class="errorform">@if(count($errors) > 0) {{$errors->first('email_address')}}@endif</label>
                                        </div>
                                        <label class="col-md-2 control-label" >{{ trans('company.companyReEmail') }}<span class="errorform">*</span></label>
                                          <div class="col-md-4">
                                        <input class="form-control input-md" name="com_email2" value="{{Request::old('com_email2')}}" placeholder="{{ trans('company.companyReEmail') }}" type="text"  data-bv-notempty="true"
data-bv-notempty-message="{{trans('validation.required', ['attribute' => trans('company.companyReEmail')])}}"
data-bv-emailaddress-message="{{trans('validation.email', ['attribute' => trans('company.companyReEmail')])}}"                data-bv-identical="true"
                data-bv-identical-field="email_address"
                data-bv-identical-message="{{trans('validation.same', ['attribute' => trans('company.companyReEmail'),'other'=>trans('company.companyEmail')])}}"/>
                                           <label class="errorform"> @if(count($errors) > 0) {{$errors->first('com_email2')}}@endif</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" >{{ trans('company.password') }}<span class="errorform">*</span></label>
                                        <div class="col-md-4">
                                        	<input class="form-control" name="user_password" placeholder="{{ trans('company.password') }}" type="password"
                data-bv-notempty="true"
                data-bv-notempty-message="{{trans('validation.required', ['attribute' => trans('company.password')])}}"
                data-bv-identical="true"
                data-bv-identical-field="password2"
                data-bv-identical-message="{{trans('validation.same', ['attribute' => trans('company.password'),'other'=>trans('company.companyRePassword')])}}"
 />
                                           <label class="errorform"> @if(count($errors) > 0) {{$errors->first('user_password')}}@endif</label>
                                        </div>
                                        <label class="col-md-2 control-label" >{{ trans('company.companyRePassword') }}<span class="errorform">*</span></label>
                                        <div class="col-md-4">
                                        	<input class="form-control" name="password2" placeholder="{{ trans('company.companyRePassword') }}" type="password"
                data-bv-notempty="true"
                data-bv-notempty-message="{{trans('validation.required', ['attribute' => trans('company.companyRePassword')])}}"
                data-bv-identical="true"
                data-bv-identical-field="password2"
                data-bv-identical-message="{{trans('validation.same', ['attribute' => trans('company.companyRePassword'),'other'=>trans('company.password')])}}" />
                                            <label class="errorform">@if(count($errors) > 0) {{$errors->first('password2')}}@endif</label>
                                        </div>
                                    </div>
                                    
                                <input class="btn btn-primary" type="submit" name="signupsubmit" value="{{ trans('company.companySignUpButton') }}" />
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



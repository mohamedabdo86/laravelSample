@include ('manasek.header')
        <div class="container">
            <h2 class="page-title">{{trans('company.profiletitle')}}</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('manasek.sidebar')
                </div>
                <div class="col-md-9">
                    <p>{{trans('company.profileEditDesc')}}</p>
                       <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> <!-- end .flash-message -->
                    <div class="gap gap-small"></div>
                    <hr>
                    <h2>{{trans('company.profileEdit')}}</h2>
                    <div class="row row-wrap">
                         <div class="row">
                                <div class="col-md-12">
                                {!! Form::open(['method'=>'POST','class'=>'form-horizontal']) !!}
                                    <div class="form-group">
                                    <label class="col-md-2 control-label" >{{ trans('company.companytype') }}<span class="errorform">*</span></label>
                                      <div class="col-md-4"> 
                                        @foreach ($lkp_agency_types as $lkp_agency_type)
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{$lkp_agency_type->AGENCY_TYPE_ID}}" name="company_type" />{{$lkp_agency_type->AGENCY_TYPE_AR}} </label>
                                        </div>
                            			@endforeach
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('company_type')}}@endif</label>
                                        </div>
                                        
                                    <label class="col-md-2 control-label" >{{ trans('company.activitytype') }}<span class="errorform">*</span></label>
                                       <div class="col-md-4"> 
                                        @foreach ($lkp_activity_types as $lkp_activity_type)
                                        <div class="checkbox-inline checkbox-small">
                                            <label>
                                                <input class="i-check" type="checkbox" value="{{$lkp_activity_type->ACTIVITY_TYPE_ID}}" name="activity_type[]" />{{$lkp_activity_type->ACTIVITY_TYPE_AR}}</label>
                                        </div>
                                       	@endforeach
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('activity_type')}}@endif</label> 
                                        </div>
                                        </div>
                                    <div class="form-group">
                                     <label class="col-md-2 control-label">{{ trans('company.country') }}<span class="errorform">*</span></label>
                                     <div class="col-md-4"> 
                                    <select name="coutryID" class="form-control">
                                     @foreach ($lkp_countries as $lkp_country)
                                        <option value="{{$lkp_country->COUNTRY_ID}}">{{$lkp_country->COUNTRY_NAME_AR}}</option>
                                       	@endforeach
                                    </select>
                                    </div>
<label class="errorform"> @if(count($errors) > 0) {{$errors->first('coutryID')}}@endif</label>                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ trans('company.companyName') }}<span class="errorform">*</span></label>
                                        <div class="col-md-4"> 
                                        <input class="form-control" name="comname" placeholder="{{ trans('company.companyName') }}" type="text" />
                                                                               <label class="errorform"> @if(count($errors) > 0) {{$errors->first('comname')}}@endif</label>  
 </div>
<label class="col-md-2 control-label"> {{ trans('company.capital') }}</label>
                                        <div class="col-md-4"> 
                                        	<input class="form-control input-md" name="capital" placeholder="{{ trans('company.capital') }}" type="number"   />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> {{ trans('company.currency') }}</label>
                                        <div class="col-md-4"> 
<select name="coutryID" class="form-control">
                                     @foreach ($lkp_currencies as $lkp_currency)
                                        <option value="{{$lkp_currency->CURRENCY_ID}}">{{$lkp_currency->CURRENCY_NAME_AR}}</option>                                       	@endforeach
                                    </select>                                        </div>
                                        <label class="col-md-2 control-label">{{ trans('company.anv') }}</label>
                                        <div class="col-md-4"> 
                                        	<input class="form-control input-md" name="anv" placeholder="{{ trans('company.anv') }}" type="number" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ trans('company.licensenumber') }}<span class="errorform">*</span></label>
                                        <div class="col-md-4"> 
                                        <input class="form-control" name="licensenumber" placeholder="{{ trans('company.licensenumber') }}" type="text"  />
                                    <label class="errorform"> @if(count($errors) > 0) {{$errors->first('licensenumber')}}@endif</label>    
    </div>
                                    
                                        <label class="col-md-2 control-label">{{ trans('company.empnumber') }}</label>
                                        <div class="col-md-4"> 
                                        <input class="form-control" name="empnumber" placeholder="{{ trans('company.empnumber') }}" type="number"  />
                                        </div>
<label class="errorform"> @if(count($errors) > 0) {{$errors->first('empnumber')}}@endif</label>    
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="col-md-3 control-label" >{{ trans('company.saulice') }}<span class="errorform">*</span></label>
                                      <div class="col-md-3"> 
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{ trans('company.yes') }}" name="company_type" />{{ trans('company.yes') }} </label>
                                        </div>
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{ trans('company.no') }}" name="company_type" />{{ trans('company.no') }} </label>
                                        </div>
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('saulice')}}@endif</label>
                                        </div>
                                    <label class="col-md-2 control-label">{{ trans('company.city') }}<span class="errorform">*</span></label>
                                    <div class="col-md-4"> 
                                    <select name="city" class="form-control">
                                     @foreach ($lkp_cities as $lkp_city)
                                        <option value="{{ $lkp_city->CITY_ID }}">{{ $lkp_city->CITY_NAME_AR }}</option>                                                                               	@endforeach

                                    </select>
                                    </div>
<label class="errorform"> @if(count($errors) > 0) {{$errors->first('city')}}@endif</label>    
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ trans('company.area') }}<span class="errorform">*</span></label>
                                        <div class="col-md-4"> 
                                    <select name="area" class="form-control">
                                     @foreach ($lkp_areas as $lkp_area)
                                        <option value="{{ $lkp_area->AREA_ID }}">{{ $lkp_area->AREA_NAME_AR }}</option>                                                                               	@endforeach

                                    </select>                                        </div>
<label class="errorform"> @if(count($errors) > 0) {{$errors->first('area')}}@endif</label>    
                                        <label class="col-md-2 control-label">{{ trans('company.zipcode') }}</label>
                                        <div class="col-md-4"> 
                                        <input class="form-control" name="zip" placeholder="{{ trans('company.zipcode') }}" type="text" />
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-md-2 control-label">{{ trans('company.address') }}<span class="errorform">*</span></label>
                                        <div class="col-md-10"> 
                                        <input class="form-control" name="address" placeholder="{{ trans('company.address') }}" type="text" />
                                        </div>
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('address')}}@endif</label>    

                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ trans('company.googlemap') }}</label>
                                        <div class="col-md-10"> 
                                        <input class="form-control" name="googlemap" placeholder="{{ trans('company.googlemap') }}" type="text" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ trans('company.mobile') }}</label>
                                        <div class="col-md-4"> 
                                        	<input class="form-control" name="com_mobile" placeholder="00xxxxxxxxxxxx" type="tel"  />
                                        </div>
                                        <label class="col-md-2 control-label">{{ trans('company.fax') }}</label>
                                        <div class="col-md-4"> 
                                        	<input class="form-control" name="com_fax" placeholder="00xxxxxxxxxxxx" type="tel" />
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ trans('company.prefcon') }}</label>
                                        <div class="col-md-4"> 
                                    <select name="area" class="form-control">
                                        <option value="{{ trans('company.phone') }}">{{ trans('company.phone') }}</option>
                                        <option value="{{ trans('company.mobile') }}">{{ trans('company.mobile') }}</option>
                                        <option value="{{ trans('company.fax') }}">{{ trans('company.fax') }}</option>
                                        <option value="{{ trans('company.companyEmail') }}">{{ trans('company.companyEmail') }}</option>
                                    </select>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ trans('company.com_website') }}</label>
                                        <div class="col-md-4"> 
                                        <input class="form-control" name="com_website" placeholder="http://www.name.domain" type="url" />
                                    </div>
                                        <label class="col-md-2 control-label">{{ trans('company.com_logo') }}</label>
                                        <div class="col-md-4"> 
                                        <input class="form-control" name="com_logo"  type="file" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ trans('company.com_desc') }}<span class="errorform">*</span></label>
                                        <textarea class="form-control" name="com_desc"></textarea>
                                                                                <label class="errorform"> @if(count($errors) > 0) {{$errors->first('com_desc')}}@endif</label>    

                                    </div>
                                <input class="btn btn-primary" type="submit" name="submit" value="{{ trans('company.sendOrder') }}" />
                                {!! Form::close() !!}
                                </div>
                            </div>
                        
                    </div>

                </div>
            </div>
        </div>


@include ('manasek.footer')
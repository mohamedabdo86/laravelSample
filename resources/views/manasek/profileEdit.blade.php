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
								{!! Form::open(['method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}

                                    <div class="form-group">
                                    <label class="col-md-2 control-label" >{{ trans('company.companytype') }}<span class="errorform">*</span></label>
                                      <div class="col-md-4"> 
                                        @foreach ($lkp_agency_types as $lkp_agency_type)
                                        <div class="radio-inline radio-small">
@if($data_agency->AGENCY_TYPE == $lkp_agency_type->AGENCY_TYPE_ID)
											{!! Form::radio('company_type', $lkp_agency_type->AGENCY_TYPE_ID, true, ['class' => 'i-radio']) !!}
@else
{!! Form::radio('company_type', $lkp_agency_type->AGENCY_TYPE_ID, false, ['class' => 'i-radio']) !!}
@endif

											{{$lkp_agency_type->AGENCY_TYPE_AR}}
											</label>
                                        </div>
                            			@endforeach
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('company_type')}}@endif</label>
                                        </div>
                                        
                                    <label class="col-md-2 control-label" >{{ trans('company.activitytype') }}<span class="errorform">*</span></label>
                                       <div class="col-md-4"> 
                                        @foreach ($lkp_activity_types as $lkp_activity_type)
                                        <div class="checkbox-inline checkbox-small">

                                            <label>
                                                
@if(in_array($lkp_activity_type->ACTIVITY_TYPE_ID, $agency_activity))
	{!! Form::checkbox('activity_type[]', $lkp_activity_type->ACTIVITY_TYPE_ID, true, ['class' => 'i-check']) !!}
@else
	{!! Form::checkbox('activity_type[]', $lkp_activity_type->ACTIVITY_TYPE_ID, null, ['class' => 'i-check']) !!}
@endif

{{$lkp_activity_type->ACTIVITY_TYPE_AR}}
</label>
                                        </div>
                                       	@endforeach
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('activity_type')}}@endif</label> 
                                        </div>
                                        </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ trans('company.companyName') }}<span class="errorform">*</span></label>
                                        <div class="col-md-4"> 
                                        <input class="form-control" name="comname" placeholder="{{ trans('company.companyName') }}" type="text" value="{{ $data_agency->AGENCY_NAME }}" />
                                                                               <label class="errorform"> @if(count($errors) > 0) {{$errors->first('comname')}}@endif</label>  
 </div>
<label class="col-md-2 control-label"> {{ trans('company.capital') }}</label>
                                        <div class="col-md-4"> 
                                        	<input class="form-control input-md" name="capital" placeholder="{{ trans('company.capital') }}" type="number" value="{{ $data_agency->CAPITAL_AMOUNT }}"   />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> {{ trans('company.currency') }}</label>
                                        <div class="col-md-4"> 
									 {!! Form::select('capital_currency', $lst_currency, $data_agency->CAPITAL_CURRENCY_ID, ['class' => 'form-control']) !!}
                                     </div>
                                        <label class="col-md-2 control-label">{{ trans('company.anv') }}</label>
                                        <div class="col-md-4"> 
                                        	<input class="form-control input-md" name="anv" placeholder="{{ trans('company.anv') }}" type="number" value="{{ $data_agency->ANNUAL_VOLUME }}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ trans('company.licensenumber') }}<span class="errorform">*</span></label>
                                        <div class="col-md-4"> 
                                        <input class="form-control" name="licensenumber" placeholder="{{ trans('company.licensenumber') }}" type="text" value="{{ $data_agency->LICENSE_NO}}" />
                                    <label class="errorform"> @if(count($errors) > 0) {{$errors->first('licensenumber')}}@endif</label>    
    </div>
                                    
                                        <label class="col-md-2 control-label">{{ trans('company.empnumber') }}</label>
                                        <div class="col-md-4"> 
                                        <input class="form-control" name="empnumber" placeholder="{{ trans('company.empnumber') }}" type="number" value="{{ $data_agency->EMPLOYEE_NO }}" />
                                        </div>
<label class="errorform"> @if(count($errors) > 0) {{$errors->first('empnumber')}}@endif</label>    
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="col-md-3 control-label" >{{ trans('company.saulice') }}<span class="errorform">*</span></label>
                                      <div class="col-md-3"> 
@if($data_agency->KSA_HAJ_APPROVED)
<div class="radio-inline radio-small">
                                            <label>
                                                <input checked="checked" class="i-radio" type="radio" value="1" name="haj_approved" />{{ trans('company.yes') }} </label>
                                        </div>
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="0" name="haj_approved" />{{ trans('company.no') }} </label>
                                        </div>
@else
<div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="1" name="haj_approved" />{{ trans('company.yes') }} </label>
                                        </div>
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input checked="checked" class="i-radio" type="radio" value="0" name="haj_approved" />{{ trans('company.no') }} </label>
                                        </div>
@endif
                                        
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('saulice')}}@endif</label>
                                        </div>
                                    
                                    </div>

                                    <div class="form-group">
                                     <label class="col-md-2 control-label">{{ trans('company.country') }}<span class="errorform">*</span></label>
                                     <div class="col-md-4"> 
									 {!! Form::select('coutryID', $lst_country, $data_agency->COUNTRY_ID, ['class' => 'form-control','id'=>'select1']) !!}


                                    </div>
<label class="errorform"> @if(count($errors) > 0) {{$errors->first('coutryID')}}@endif</label> 
<label class="col-md-2 control-label">{{ trans('company.city') }}<span class="errorform">*</span></label>
                                    <div class="col-md-4"> 
									
									 <select id="select2" name="city">
									 @foreach($lst_city as $city)
									 @if($city->CITY_ID == $data_agency->CITY_ID)
									 	 <option selected="selected" value="{{ $city->CITY_ID }}" class="{{ $city->COUNTRY_ID }}">{{ $city->CITY_NAME_AR }}</option>
									 @else
										<option value="{{ $city->CITY_ID }}" class="{{ $city->COUNTRY_ID }}">{{ $city->CITY_NAME_AR }}</option>
									 @endif

									 @endforeach
									 </select>
                                    </div>
<label class="errorform"> @if(count($errors) > 0) {{$errors->first('city')}}@endif</label>    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ trans('company.area') }}<span class="errorform">*</span></label>
                                        <div class="col-md-4"> 
										
										
									 <select id="select3" name="area">
									 @foreach($lst_area as $area)
									 @if($area->AREA_ID == $data_agency->AREA_ID)
									 <option selected="selected" value="{{ $area->AREA_ID }}" class="{{ $area->CITY_ID }}">{{ $area->AREA_NAME_AR }}</option>
									 @else
									 <option value="{{ $area->AREA_ID }}" class="{{ $area->CITY_ID }}">{{ $area->AREA_NAME_AR }}</option>
									 @endif

									 @endforeach
									 </select>

									</div>
									<label class="errorform"> @if(count($errors) > 0) {{$errors->first('area')}}@endif</label>    
                                        <label class="col-md-2 control-label">{{ trans('company.zipcode') }}</label>
                                        <div class="col-md-4"> 
                                        <input class="form-control" name="zip" placeholder="{{ trans('company.zipcode') }}" type="text" value="{{ $data_agency->POSTAL_CODE }}" />
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-md-2 control-label">{{ trans('company.address') }}<span class="errorform">*</span></label>
                                        <div class="col-md-10"> 
                                        <input class="form-control" name="address" placeholder="{{ trans('company.address') }}" type="text" value="{{ $data_agency->ADDRESS }}" />
                                        </div>
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('address')}}@endif</label>    

                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ trans('company.googlemap') }}</label>
                                        <div class="col-md-10"> 
                                        <input class="form-control" name="googlemap" placeholder="{{ trans('company.googlemap') }}" type="text" value="{{ $data_agency->googlemap }}" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        
                                    </div>
                                    <div class="form-group">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">{{ trans('company.com_website') }}</label>
                                        <div class="col-md-4"> 
                                        <input class="form-control" name="com_website" placeholder="http://www.name.domain" type="url" value="{{ $data_agency->AGENCY_URL }}"  />
                                    </div>
                                        <label class="col-md-2 control-label">{{ trans('company.com_logo') }}</label>
                                        <div class="col-md-4"> 
                                        <input class="form-control" name="com_logo"  type="file" />

										{!! HTML::image('uploads/'.$data_agency->AGENCY_LOGO) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ trans('company.com_desc') }}<span class="errorform">*</span></label>
                                        <textarea class="form-control" name="com_desc">{{ $data_agency->AGENCY_DESCRIPTION }}</textarea>
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
{!!@script('js/jquery.chained.min.js')!!}
<script language="javascript">
  $(function(){
    $("#select2").chained("#select1");
	$("#select3").chained("#select2");

  });
</script>
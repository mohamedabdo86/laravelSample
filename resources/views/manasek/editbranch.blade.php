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
                    <p>{{trans('company.editBranchMainDesc')}}</p>
                       <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
    
  </div> <!-- end .flash-message -->
                    <div class="gap gap-small"></div>
                    <hr>
                    <h2>{{trans('company.editBranch')}}</h2>
                    <div class="row row-wrap">
                         {!! Form::open(['method'=>'POST','class'=>'form-horizontal']) !!}
                         @if ($active == 'none')       
                                <div class='alert alert-danger'>
                                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                          <p>{{trans('company.notAllowed')}}</p>
                                    </div>

                                @else 
                                <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('company.companyName')}}</label>
                                          <div class="col-md-6">
                                        <input class="form-control input-md" name="companyName" placeholder="{{trans('company.companyName')}}" type="text" disabled="disabled" value="{{$companyName}}"  />
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('company.branchName')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                        <input class="form-control input-md" name="branchName" placeholder="{{trans('company.branchName')}}" type="text" value="{{$branches->BRANCH_NAME}}" />
                                           <label class="errorform"> @if(count($errors) > 0) {{$errors->first('branchName')}}@endif</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">{{ trans('company.city') }}<span class="errorform">*</span></label>
                                    <div class="col-md-6"> 
                                    <select name="city" class="form-control">
									<option value="">{{ trans('company.city') }}</option>
                                     @foreach ($lkp_cities as $lkp_city)
                                        <option value="{{ $lkp_city->CITY_ID }}" 
                                        @if ($branches->CITY_ID == $lkp_city->CITY_ID)
                                        	 selected="selected"
                                        @endif
                                        >{{ $lkp_city->CITY_NAME_AR }}</option>                                                                               	@endforeach

                                    </select>
									<label class="errorform"> @if(count($errors) > 0) {{$errors->first('city')}}@endif</label>    
                                    </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="col-md-3 control-label">{{ trans('company.area') }}<span class="errorform">*</span></label>
                                    <div class="col-md-6"> 
                                    <select name="area" class="form-control">
									<option value="">{{ trans('company.area') }}</option>
                                     @foreach ($lkp_areas as $lkp_area)
                                        <option value="{{ $lkp_area->AREA_ID }}"
                                        @if ($branches->AREA_ID == $lkp_area->AREA_ID)
                                        	 selected="selected"
                                        @endif
                                        >{{ $lkp_area->AREA_NAME_AR }}</option>                                     @endforeach
                                    </select>
									<label class="errorform"> @if(count($errors) > 0) {{$errors->first('area')}}@endif</label> 
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">{{ trans('company.address') }}<span class="errorform">*</span></label>
                                        <div class="col-md-6"> 
                                        <input class="form-control" name="address" placeholder="{{ trans('company.address') }}" type="text"  value="{{$branches->ADDRESS}}"/>
                                                                                <label class="errorform"> @if(count($errors) > 0) {{$errors->first('address')}}@endif</label>    
</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">{{ trans('company.zipcode') }}</label>
                                        <div class="col-md-6"> 
                                        <input class="form-control" name="zip" placeholder="{{ trans('company.zipcode') }}" type="text" value="{{$branches->POSTAL_CODE}}" />
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">{{ trans('company.prefcon') }}<span class="errorform">*</span></label>
                                        <div class="col-md-6"> 
                                    <select name="prefcon" class="form-control">
                                        <option value="">{{ trans('company.prefcon') }}</option>
                                        <option value="{{ trans('company.phone') }}">{{ trans('company.phone') }}</option>
                                        <option value="{{ trans('company.mobile') }}">{{ trans('company.mobile') }}</option>
                                        <option value="{{ trans('company.fax') }}">{{ trans('company.fax') }}</option>
                                        <option value="{{ trans('company.companyEmail') }}">{{ trans('company.companyEmail') }}</option>
                                    </select>
                                                                                                                    <label class="errorform"> @if(count($errors) > 0) {{$errors->first('prefcon')}}@endif</label>    

                                    </div>
                                    </div>
<div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                      <div class="col-md-6">
                                        <input class="form-control" name="prefconValue" placeholder="{{ trans('company.prefcon') }}" type="text" value="{{Request::old('prefconValue')}}" />
                                      <label class="errorform"> @if(count($errors) > 0) {{$errors->first('prefconValue')}}@endif</label>                                    </div>
                                    </div>                                <input class="btn btn-primary" type="submit" name="submit" value="{{trans('company.edit')}}" />
                                @endif
                                {!! Form::close() !!}
                        
                    </div>

                </div>
            </div>
        </div>


@include ('manasek.footer')

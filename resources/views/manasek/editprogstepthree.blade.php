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
                    <p>{{trans('programm.addHagprogramms2Desc')}}</p>
                       <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
    
  </div> <!-- end .flash-message -->

                    <div class="gap gap-small"></div>
                    <hr>
                    <div class="row row-wrap">
                        <div class="col-md-12">
                            <h4>{{trans('programm.travelWayLine')}} :{{trans('programm.travelaway')}}</h4>

                           {!! Form::open(['method'=>'POST','class'=>'form-horizontal']) !!}
                         @if ($active == 'none')       
                                <div class='alert alert-danger'>
                                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                          <p>{{trans('company.notAllowed')}}</p>
                                    </div>

                                @else
<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.FROM_PORT')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                     <select name="FROM_PORT" class="form-control js-example-basic-singleeee">
									<option value="">{{ trans('programm.FROM_PORT') }}</option>
                                     @foreach ($FROM_PORTs as $FROM_PORT)
                                        <option value="{{ $FROM_PORT->PORT_ID }}"
                                                                            @if ($oldprogtransportation)
@if ($FROM_PORT->PORT_ID == $oldprogtransportation->FROM_PORT_ID) selected="selected" @endif                                          @endif

                                          >{{ $FROM_PORT->PORT_NAME_AR }}</option>                                     @endforeach
                                    </select>
									<label class="errorform"> @if(count($errors) > 0) {{$errors->first('FROM_PORT')}}@endif</label> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.TO_PORT')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                     <select name="TO_PORT" class="form-control  js-example-basic-singleee">
									<option value="">{{ trans('programm.TO_PORT') }}</option>
                                     @foreach ($FROM_PORTs as $FROM_PORT)
                                        <option value="{{ $FROM_PORT->PORT_ID }}"
                                       @if ($oldprogtransportation) @if ($FROM_PORT->PORT_ID == $oldprogtransportation->TO_PORT_ID) selected="selected" @endif @endif>{{ $FROM_PORT->PORT_NAME_AR }}</option>                                     @endforeach

                                    </select>
									<label class="errorform"> @if(count($errors) > 0) {{$errors->first('TO_PORT')}}@endif</label> 
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.DIRECT_FLIGHT')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.yes')}}" name="DIRECT_FLIGHT" checked="checked"  /> {{trans('company.yes')}}</label>
                                        </div>
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.no')}}" name="DIRECT_FLIGHT" /> {{trans('company.no')}}</label>
                                        </div>
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('DIRECT_FLIGHT')}}@endif</label>
                                        </div>
                                    </div>
                                    @if ($oldprog->TRAVEL_METHOD_ID == 3)
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.AIRLINE_ID')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                     <select name="AIRLINE_ID" class="form-control js-example-basic-singleAIRLINE_ID">
									<option value="">{{ trans('programm.AIRLINE_ID') }}</option>
                                     @foreach ($lkp_airlines as $lkp_airline)
                                        <option value="{{ $lkp_airline->AIRLINE_ID }}"@if ($oldprogtransportation) @if ($FROM_PORT->PORT_ID == $oldprogtransportation->AIRLINE_ID) selected="selected" @endif @endif>{{ $lkp_airline->AIRLINE_NAME_AR }}</option>                                     @endforeach

                                    </select>
									<label class="errorform"> @if(count($errors) > 0) {{$errors->first('AIRLINE_ID')}}@endif</label> 
                                        </div>
                                    </div>       
                                    @endif  
                                    
                                <h4>{{trans('programm.travelWayLine')}} :{{trans('programm.returnHome')}}</h4>
<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.FROM_PORT')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                     <select name="FROM_PORTRE" class="form-control js-example-basic-singlee" id="js-example-basic-single">
									<option value="">{{ trans('programm.FROM_PORT') }}</option>
                                     @foreach ($FROM_PORTs as $FROM_PORT)
                                        <option value="{{ $FROM_PORT->PORT_ID }}"
                                        @if ($oldprogtransportation) @if ($FROM_PORT->PORT_ID == $oldprogtransportation->FROM_PORT_IDRE) selected="selected" @endif @endif
                                          >{{ $FROM_PORT->PORT_NAME_AR }}</option>                                     @endforeach

                                    </select>
									<label class="errorform"> @if(count($errors) > 0) {{$errors->first('FROM_PORTRE')}}@endif</label> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.TO_PORT')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                     <select name="TO_PORTRE" class="form-control js-example-basic-single">
									<option value="">{{ trans('programm.TO_PORT') }}</option>
                                     @foreach ($FROM_PORTs as $FROM_PORT)
                                        <option value="{{ $FROM_PORT->PORT_ID }}"@if ($oldprogtransportation) @if ($FROM_PORT->PORT_ID == $oldprogtransportation->TO_PORT_IDRE) selected="selected" @endif @endif>{{ $FROM_PORT->PORT_NAME_AR }}</option>                                     @endforeach

                                    </select>
									<label class="errorform"> @if(count($errors) > 0) {{$errors->first('TO_PORTRE')}}@endif</label> 
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.DIRECT_FLIGHT')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.yes')}}" name="DIRECT_FLIGHTRE" checked="checked"  /> {{trans('company.yes')}}</label>
                                        </div>
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.no')}}" name="DIRECT_FLIGHTRE" /> {{trans('company.no')}}</label>
                                        </div>
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('DIRECT_FLIGHT')}}@endif</label>
                                        </div>
                                    </div>
                                    @if ($oldprog->TRAVEL_METHOD_ID == 3)
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.AIRLINE_ID')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                     <select name="AIRLINE_IDRE" class="form-control js-example-basic-singleAIRLINE_IDRE">
									<option value="">{{ trans('programm.AIRLINE_ID') }}</option>
                                     @foreach ($lkp_airlines as $lkp_airline)
                                        <option value="{{ $lkp_airline->AIRLINE_ID }}">{{ $lkp_airline->AIRLINE_NAME_AR }}</option>                                     @endforeach

                                    </select>
									<label class="errorform"> @if(count($errors) > 0) {{$errors->first('AIRLINE_IDRE')}}@endif</label> 
                                        </div>
                                    </div>       
                                    @endif                              <input class="btn btn-primary" type="submit" name="submit" value="{{ trans('programm.nextStep') }}" />

                                @endif
                                {!! Form::close() !!}
                   </div>

                </div>
            </div>
        </div>


@include ('manasek.footer')
{!!@style('css/select2.min.css')!!}
{!!@style('css/select2-bootstrap.css')!!}
{!!@script('js/select2.full.js')!!}
<script type="text/javascript">
$(document).ready(function() {
  $(".js-example-basic-single").select2({
    language: "ar",
 	dir: "rtl"
  });
  $(".js-example-basic-singlee").select2({
    language: "ar",
 	dir: "rtl"
  });
  $(".js-example-basic-singleee").select2({
    language: "ar",
 	dir: "rtl"
  });
  $(".js-example-basic-singleeee").select2({
    language: "ar",
 	dir: "rtl"
  });
    $(".js-example-basic-singleAIRLINE_ID").select2({
    language: "ar",
 	dir: "rtl"
  });
      $(".js-example-basic-singleAIRLINE_IDRE").select2({
    language: "ar",
 	dir: "rtl"
  });
});</script>

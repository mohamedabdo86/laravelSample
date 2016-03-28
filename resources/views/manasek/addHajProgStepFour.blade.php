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
                            <h4>{{trans('programm.program_accommodation_in') . trim($cityName->CITY_NAME_AR)}}</h4>

                           {!! Form::open(['method'=>'POST','class'=>'form-horizontal']) !!}
                         @if ($active == 'none')       
                                <div class='alert alert-danger'>
                                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                          <p>{{trans('company.notAllowed')}}</p>
                                    </div>

                                @else
<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.hotelName')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                     <select name="hotelName" class="form-control js-example-basic-singleeee">
									<option value="">{{ trans('programm.hotelName') }}</option>
                                     @foreach ($hotels as $hotel)
                                        <option value="{{$hotel->HOTEL_ID}}"
                                       @if ($program_accommodations) @if ($program_accommodations->HOTEL_ID == $hotel->HOTEL_ID)  selected="selected" @endif @endif
                                      >{{$hotel->HOTEL_NAME_AR}}</option>                                     @endforeach

                                    </select>
									<label class="errorform"> @if(count($errors) > 0) {{$errors->first('hotelName')}}@endif</label>
                                     </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.accommodation_grade')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                     <select name="accommodation_grade" class="form-control js-example-basic-singleee">
									<option value="">{{ trans('programm.accommodation_grade') }}</option>
                                     @foreach ($accommodation_grades as $accommodation_grade)
                                        <option value="{{$accommodation_grade->ACCOMMODATION_GRADE_ID}}"
                                     @if ($program_accommodations) @if ($program_accommodations->ACCOMMODATION_GRADE_ID == $accommodation_grade->ACCOMMODATION_GRADE_ID)  selected="selected" @endif @endif
                                      >{{$accommodation_grade->GRADE_NAME_AR}}</option>                                     @endforeach

                                    </select>
                                     </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.WITH_BREAKFAST')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                     <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.yes')}}" name="WITH_BREAKFAST" @if ($program_accommodations) @if ($program_accommodations->WITH_BREAKFAST == trans('company.yes')) checked="checked" @endif @endif  /> {{trans('company.yes')}}</label>
                                        </div>
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.no')}}" name="WITH_BREAKFAST" @if ($program_accommodations) @if ($program_accommodations->WITH_BREAKFAST == trans('company.no')) checked="checked" @endif @endif  /> {{trans('company.no')}}</label>
                                        </div>
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('WITH_BREAKFAST')}}@endif</label>
                                     </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.WITH_LUNCH')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                     <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.yes')}}" name="WITH_LUNCH" @if ($program_accommodations) @if ($program_accommodations->WITH_LUNCH == trans('company.yes')) checked="checked" @endif @endif  /> {{trans('company.yes')}}</label>
                                        </div>
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.no')}}" name="WITH_LUNCH" @if ($program_accommodations) @if ($program_accommodations->WITH_LUNCH == trans('company.no')) checked="checked" @endif @endif/> {{trans('company.no')}}</label>
                                        </div>
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('WITH_LUNCH')}}@endif</label>
                                        </div>
                                     </div>
<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.WITH_DINNER')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                     <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.yes')}}" name="WITH_DINNER"@if ($program_accommodations) @if ($program_accommodations->WITH_DINNER == trans('company.yes')) checked="checked" @endif @endif /> {{trans('company.yes')}}</label>
                                        </div>
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.no')}}" name="WITH_DINNER" @if ($program_accommodations) @if ($program_accommodations->WITH_DINNER == trans('company.no')) checked="checked" @endif @endif/> {{trans('company.no')}}</label>
                                        </div>
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('WITH_DINNER')}}@endif</label>
                                        </div>
                                     </div>
                                     <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.NUMBER_OF_NIGHTS')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                        <input name="NUMBER_OF_NIGHTS" placeholder="{{trans('programm.NUMBER_OF_NIGHTS')}}"  class="form-control input-md"  type="number" value="@if ($program_accommodations){{$program_accommodations->NUMBER_OF_NIGHTS}}@endif" />
                                           <label class="errorform"> @if(count($errors) > 0) {{$errors->first('NUMBER_OF_NIGHTS')}}@endif</label>
                                        </div>
                                    </div>
                                    @if ($cityId == 3 || $cityId == 7) 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.DISTANCE_FROM_HARAM')}}</label>
                                          <div class="col-md-6">
                                        <input name="DISTANCE_FROM_HARAM" placeholder="{{trans('programm.DISTANCE_FROM_HARAM')}}"  class="form-control input-md"  type="number" value="@if($program_accommodations){{$program_accommodations->DISTANCE_FROM_HARAM}}@endif" />
                                        </div>
                                    </div>
                                    @endif
                                    @if ($cityId == 9) 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.DISTANCE_FROM_jamarat')}}</label>
                                          <div class="col-md-6">
                                        <input name="DISTANCE_FROM_jamarat" placeholder="{{trans('programm.DISTANCE_FROM_jamarat')}}"  class="form-control input-md"  type="number" value="@if ($program_accommodations){{$program_accommodations->DISTANCE_FROM_jamarat}}@endif" />
                                        </div>
                                    </div>
                                    @endif
                                     <input class="btn btn-primary" type="submit" name="submit" value="{{ trans('programm.nextStep') }}" />
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

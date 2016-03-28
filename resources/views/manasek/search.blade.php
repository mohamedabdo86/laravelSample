@include ('manasek.header')
        <div class="container">
            <h2 class="page-title">{{trans('search.searchTitle')}}</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include ('manasek.sidebar')
                </div>
                <div class="col-md-9">
                    <p>{{trans('search.search1Desc')}}</p>
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
                           {!! Form::open(['method'=>'POST','class'=>'form-horizontal']) !!}
                         @if ($active == 'none')       
                                <div class='alert alert-danger'>
                                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                          <p>{{trans('company.notAllowed')}}</p>
                                    </div>

                                @else
								<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('search.programType')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('search.programHijyes')}}" name="programType" checked="checked" /> {{trans('search.programHijyes')}}</label>
                                        </div>
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('search.programHijNo')}}" name="programType" /> {{trans('search.programHijNo')}}</label>
                                        </div>
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('programType')}}@endif</label>
                                        </div>
                                    </div>
                             <div class="form-group">
								<label class="col-md-3 control-label" >{{trans('search.travelSeason')}}<span class="errorform">*</span></label>
									<div class="col-md-6">
										{!! Form::select('lkp_season', $lkp_season, Request::old('lkp_season'), ['class' => 'form-control']) !!}
									</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label" >{{trans('search.travelMethod')}}<span class="errorform">*</span></label>
								<div class="col-md-6">
									{!! Form::select('lkp_travel_method', $lkp_travel_methods, Request::old('lkp_travel_method'), ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('search.travelDate')}}<span class="errorform">*</span></label>
                                        <div class="col-md-6">
											<input name="travelDate" placeholder="{{trans('search.travelDate')}}"  class="date-pick form-control" data-date-format="yyyy-mm-dd" type="text" value="{{Request::old('travelDate')}}" id="date-pick-b-d" />
                                           <label class="errorform"> @if(count($errors) > 0) {{$errors->first('travelDate')}}@endif</label>
                                        </div>
                              </div>
							<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('search.travelElasticDate')}}<span class="errorform">*</span></label>
                                        <div class="col-md-6">
										
										{!! Form::checkbox('travelElasticDate', 1, Request::old('travelElasticDate',true)); !!}
                                        </div>
                            </div>
							<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('search.travelPrice')}}<span class="errorform">*</span></label>
                                        <div class="col-md-6">
											{!! Form::select('program_price', $program_price, Request::old('program_price'), ['class' => 'form-control']) !!}
                                        </div>
                              </div>
							<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('search.travelCountry')}}<span class="errorform">*</span></label>
                                        <div class="col-md-6">
											 {!! Form::select('travelCountry', $lkp_country, Request::old('travelCountry'), ['class' => 'form-control','id'=>'select1']) !!}
                                        </div>
                            </div>
							<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('search.travelCity')}}<span class="errorform">*</span></label>
                                        <div class="col-md-6">
											 <select id="select2" name="city">
												 @foreach($lkp_city as $city)
													 <option value="{{ $city->CITY_ID }}" class="{{ $city->COUNTRY_ID }}">{{ $city->CITY_NAME_AR }}</option>
												 @endforeach
											 </select>
                                        </div>
                              </div>       
							  <div class="form-group">
								<label class="col-md-3 control-label" >{{trans('search.searchOrder')}}<span class="errorform">*</span></label>
									<div class="col-md-6">
										<select name="searchOrder" class="form-control">
											<option value="OrderPriceASC">
												{{ trans('search.searchOrderPriceASC') }}
											</option>
											<option value="OrderPriceDesc">
												{{ trans('search.searchOrderPriceDesc') }}
											</option>
											<option value="OrderLevel">
												{{ trans('search.searchOrderLevel') }}
											</option>
											<option value="OrderDate">
												{{ trans('search.searchOrderDate') }}
											</option>
											<option value="OrderWayLine">
												{{ trans('search.searchOrderWayLine') }}
											</option>
											<option value="OrderNew">
												{{ trans('search.searchOrderNew') }}
											</option>
											<option value="OrderView">
												{{ trans('search.searchOrderView') }}
											</option>
											<option value="OrderBooking">
												{{ trans('search.searchOrderBooking') }}
											</option>
											<option value="OrderFiv">
												{{ trans('search.searchOrderFiv') }}
											</option>
										</select>
									</div>
							</div>
							<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('search.programLevel')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                     <select name="programLevel" class="form-control">
									<option value="">{{ trans('search.programLevel') }}</option>
                                     @foreach ($lkp_program_levels as $lkp_program_level)
                                        <option value="{{ $lkp_program_level->PROGRAM_LEVEL_ID }}">{{ $lkp_program_level->PROGRAM_LEVEL_AR }}</option>
									  @endforeach
                                    </select>
									<label class="errorform"> @if(count($errors) > 0) {{$errors->first('programLevel')}}@endif</label> 
                                        </div>
								</div>
								<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('search.accommodationGrade')}}<span class="errorform">*</span></label>
                                        <div class="col-md-6">
											 {!! Form::select('lkp_accommodation_grade', $lkp_accommodation_grade, Request::old('lkp_accommodation_grade'), ['class' => 'form-control']) !!}
                                        </div>
                            </div>
							<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('search.Makkah')}}<span class="errorform">*</span></label>
                                 <div class="col-md-6">										
										<div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="Makkah" name="searchMakkah" checked="checked" /> {{trans('search.Makkah')}}</label>
                                        </div>
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="Madīnah" name="searchMakkah" /> {{trans('search.Madīnah')}}</label>
                                        </div>
                                     </div>
                            </div>
							<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('search.VisitMadīnah')}}<span class="errorform">*</span></label>
                                 <div class="col-md-6">										
										<div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="1" name="VisitMadīnah" checked="checked" /> {{trans('company.yes')}}</label>
                                        </div>
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="0" name="VisitMadīnah" /> {{trans('company.no')}}</label>
                                        </div>
                                     </div>
                            </div>
							<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('search.AIRLINE_ID')}}<span class="errorform">*</span></label>
                                        <div class="col-md-6">
											 {!! Form::select('lkp_airlines', $lkp_airlines, Request::old('lkp_airlines'), ['class' => 'form-control']) !!}
                                        </div>
                            </div>
							<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('search.Airline_Time')}}<span class="errorform">*</span></label>
                                        <div class="col-md-6">
										<input name="Airline_Time" placeholder="{{trans('search.Airline_Time')}}"  class="form-control"  type="text" value="{{Request::old('Airline_Time')}}" />
                                        </div>
                            </div>
								<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('search.containtiket')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.yes')}}" name="containtiket" checked="checked" /> {{trans('company.yes')}}</label>
                                        </div>
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.no')}}" name="containtiket" /> {{trans('company.no')}}</label>
                                        </div>
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('containtiket')}}@endif</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('search.containVisa')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.yes')}}" name="containVisa" checked="checked" /> {{trans('company.yes')}}</label>
                                        </div>
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.no')}}" name="containVisa" /> {{trans('company.no')}}</label>
                                        </div>
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('containVisa')}}@endif</label>
                                        </div>
                                    </div>

                                   
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('search.gateDiscount')}}</label>
                                          <div class="col-md-5">
                                        <input name="gateDiscount" placeholder="{{trans('search.gateDiscount')}}"  class="form-control input-md"  type="number" value="{{Request::old('gateDiscount')}}" />
                                           <label class="errorform"> @if(count($errors) > 0) {{$errors->first('gateDiscount')}}@endif</label>
                                        </div>
                                        <div class="col-md-1">%</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('search.takseetAllowed')}}</label>
                                          <div class="col-md-6">
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.yes')}}" name="takseetAllowed" /> {{trans('company.yes')}}</label>
                                        </div>
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.no')}}" name="takseetAllowed"  checked="checked"/> {{trans('company.no')}}</label>
                                        </div>
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('takseetAllowed')}}@endif</label>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('search.ryalExchangeRate')}}</label>
                                          <div class="col-md-6">
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.yes')}}" name="ryalExchangeRate"  checked="checked" /> {{trans('company.yes')}}</label>
                                        </div>
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.no')}}" name="ryalExchangeRate"/> {{trans('company.no')}}</label>
                                        </div>
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('takseetAllowed')}}@endif</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('search.ticketExchangeRate')}}</label>
                                          <div class="col-md-6">
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.yes')}}" name="ticketExchangeRate"  checked="checked" /> {{trans('company.yes')}}</label>
                                        </div>
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('company.no')}}" name="ticketExchangeRate"/> {{trans('company.no')}}</label>
                                        </div>
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('ticketExchangeRate')}}@endif</label>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.PERSON_PER_ROOM')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                     <select name="PERSON_PER_ROOM" class="form-control js-example-basic-singleeee">
									 <option value="">{{ trans('programm.PERSON_PER_ROOM') }}</option>
                                     <option value="1">{{trans('programm.singleRoom')}}</option>
                                      <option value="2">{{trans('programm.doubleRoom')}}</option>
                                      <option value="3">{{trans('programm.tripleRoom')}}</option>
                                      <option value="4">{{trans('programm.quadRoom')}}</option>
                                      <option value="5">{{trans('programm.moreQuadRoom')}}</option>                                    </select>
									<label class="errorform"> @if(count($errors) > 0) {{$errors->first('PERSON_PER_ROOM')}}@endif</label>
                                     </div>
                                    </div>
                            <input class="btn btn-primary" type="submit" name="submit" value="{{ trans('search.submit') }}" />

                                @endif
                                {!! Form::close() !!}
                   </div>

                </div>
            </div>
        </div>


@include ('manasek.footer')
<script language="javascript">
var travelDate = "{{Request::old('travelDate')}}";
var returnDate = "{{Request::old('returnDate')}}";
$('#date-pick-b-d').datepicker('setDate', travelDate);
$('#date-pick-s-d').datepicker('setDate', returnDate);
//$('').datepicker('update', '');
</script>
{!!@script('js/jquery.chained.min.js')!!}
<script language="javascript">
  $(function(){
    $("#select2").chained("#select1");
  });
</script>
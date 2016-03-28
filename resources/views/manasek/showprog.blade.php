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
                    <p>{{trans('company.showprogMainDesc')}}</p>
                       <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
    
  </div> <!-- end .flash-message -->
                    <div class="gap gap-small"></div>
                    <hr>
                    <h2>{{trans('company.showprogram')}} <span class="errorform">{{$prog->PROGRAM_NAME}}</span></h2>
                    <span class="errorform">{{trans('programm.noOfViews')}} : {{$prog->noOfViews}}</span><br />
                    <span class="errorform">{{trans('programm.favProgAdded')}} : {{$favProgAdded}}</span><br />
                    <span class="errorform">{{trans('programm.progOrders')}} : {{$progOrders}}</span><br />
                    <span class="errorform"></span>
                    <div class="row row-wrap">
                    <table class="table table-bordered table-striped table-booking-history">
  <tr>
    <td>{{trans('company.progName')}}</td>
    <td>{{$prog->PROGRAM_NAME}}</td>
  </tr>
    <tr>
    <td>{{trans('programm.season')}}</td>
    <td>{{$seasonName->SEASON_TYPE_AR}} : {{$seasonName->G_YEAR}}/{{$seasonName->H_YEAR}}</td>
  </tr>
  <tr>
    <td>{{trans('programm.programLevel')}}</td>
    <td>{{$lkp_program_level->PROGRAM_LEVEL_AR}}</td>
  </tr>
   <tr>
    <td>{{trans('programm.travelMethod')}}</td>
    
    <td>{{$lkp_travel_method->TRAVEL_METHOD_AR}}</td>
  </tr>
  @if ($programtransportation)
     <tr>
    <td colspan="2">{{trans('programm.travelWayLine')}}</td>
    </tr>
<tr>
    <td>{{trans('programm.steptwo')}}</td>
    <td>{{$programtransportation->travelWayLine}}</td>
  </tr>
       <tr>
    <td colspan="2">{{trans('programm.travelaway')}}</td>
    </tr>
  <tr>
    <td>{{ trans('programm.FROM_PORT') }}</td>
    <td>{{$programtransportation->PORT_NAME_AR}}</td>
  </tr>
    <tr>
    <td>{{ trans('programm.TO_PORT') }}</td>
    <td>{{$TO_PORT_Name}}</td>
  </tr>
    <tr>
    <td>{{ trans('programm.DIRECT_FLIGHT') }}</td>
    <td>{{$programtransportation->DIRECT_FLIGHT}}</td>
  </tr>
  @if ($prog->TRAVEL_METHOD_ID == 3)
  <tr>
    <td>{{ trans('programm.AIRLINE_ID') }}</td>
    <td>{{$lkp_airline}}</td>
  </tr>

  @endif
<tr>
    <td colspan="2">{{trans('programm.returnHome')}}</td>
    </tr>
      <tr>
    <td>{{ trans('programm.FROM_PORT') }}</td>
    <td>{{$FROM_PORT_NameRE}}</td>
  </tr>
    <tr>
    <td>{{ trans('programm.TO_PORT') }}</td>
    <td>{{$TO_PORT_NameRE}}</td>
  </tr>
  @if ($prog->TRAVEL_METHOD_ID == 3)
  <tr>
    <td>{{ trans('programm.AIRLINE_ID') }}</td>
    <td>{{$lkp_airlineRE}}</td>
  </tr>

  @endif
    @endif
    <tr>
    <td colspan="2" align="center">{{trans('programm.stepfour')}}</td>
    </tr>
    @if ($programaccommod)
    @foreach ($programaccommod as $programaccommo)
   <tr>
    <td colspan="2">{{trans('programm.program_accommodation_in') . $programaccommo->CITY_NAME_AR}}</td>
    </tr>
      <tr>
    <td>{{ trans('programm.hotelName') }}</td>
    <td>{{$programaccommo->HOTEL_NAME_AR}}</td>
  </tr>
<tr>
    <td>{{ trans('programm.accommodation_grade') }}</td>
    <td>{{$programaccommo->GRADE_NAME_AR}}</td>
  </tr>
  <tr>
    <td>{{ trans('programm.WITH_BREAKFAST') }}</td>
    <td>{{$programaccommo->WITH_BREAKFAST}}</td>
  </tr>
    <tr>
    <td>{{ trans('programm.WITH_LUNCH') }}</td>
    <td>{{$programaccommo->WITH_LUNCH}}</td>
  </tr>
    <tr>
    <td>{{ trans('programm.WITH_DINNER') }}</td>
    <td>{{$programaccommo->WITH_DINNER}}</td>
  </tr>
      <tr>
    <td>{{ trans('programm.NUMBER_OF_NIGHTS') }}</td>
    <td>{{$programaccommo->NUMBER_OF_NIGHTS}}</td>
  </tr>
  @if ($programaccommo->CITY_ID == 3 || $programaccommo->CITY_ID == 7) 
   <tr>
    <td>{{ trans('programm.DISTANCE_FROM_HARAM') }}</td>
    <td>{{$programaccommo->DISTANCE_FROM_HARAM}}</td>
  </tr>
  @endif
    @if ($programaccommo->CITY_ID == 9) 
   <tr>
    <td>{{ trans('programm.DISTANCE_FROM_jamarat') }}</td>
    <td>{{$programaccommo->DISTANCE_FROM_jamarat}}</td>
  </tr>
  @endif
    @endforeach
    @endif
@if ($oldprices)
    <tr>
    <td colspan="2" align="center">{{trans('programm.stepfive')}}</td>
    </tr>
    </table>
                     <table class="table table-bordered table-striped table-booking-history">
                        <thead>
                            <tr>
                                <th>{{trans('programm.AGE_CATEGORY_ID')}}</th>
                                <th>{{trans('programm.PERSON_PER_ROOM')}}</th>
								<th>{{trans('company.currency')}}</th>
                                <th>{{trans('programm.P_PRICE')}}</th>
                                <th>{{trans('company.edit')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($oldprices as $oldprice)
                        <tr id="{{$oldprice->PROGRAM_PRICE_ID}}"><td>{{$oldprice->AGE_CATEGORY_AR}}</td><td>{{$oldprice->PERSON_PER_ROOM}}</td><td>{{$oldprice->CURRENCY_NAME_AR}}</td><td>{{$oldprice->PRICE}}</td><td>{!!link_to('/company/program/prices/edit/'. $oldprice->PROGRAM_PRICE_ID . "/" . $id . "/" . $activityID,trans('company.edit'))!!}</td></tr>
                        
                        @endforeach
                        </tbody>
                        </table>
                                                @endif


                  </div>

                </div>
            </div>
        </div>


@include ('manasek.footer')

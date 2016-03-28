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
                    <p>{{trans('programm.addHagprogramms1Desc')}}</p>
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
                            <h4>{{trans('company.addHajProg',['progtypeName'=>$lkp_activity_type->ACTIVITY_TYPE_AR])}}</h4>

                           {!! Form::open(['method'=>'POST','class'=>'form-horizontal']) !!}
                         @if ($active == 'none')       
                                <div class='alert alert-danger'>
                                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                          <p>{{trans('company.notAllowed')}}</p>
                                    </div>

                                @else
                                 <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.season')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                   <select name="season" class="form-control">
									<option value="">{{ trans('programm.season') }}</option>
                                       @foreach ($lkp_seasons as $lkp_season)
									<option value="{{$lkp_season->SEASON_ID}}">{{$lkp_season->SEASON_TYPE_AR}} :  {{$lkp_season->G_YEAR}}/{{$lkp_season->H_YEAR}}</option>
                            			@endforeach
                                        </select>
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('lkp_season')}}@endif</label>
                                        </div>
                                    </div>
                             <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.programName')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                        <input class="form-control input-md" name="programName" placeholder="{{trans('programm.programName')}}" type="text" value="{{Request::old('programName')}}" />
                                           <label class="errorform"> @if(count($errors) > 0) {{$errors->first('programName')}}@endif</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.travelMethod')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                       @foreach ($lkp_travel_methods as $lkp_travel_method)
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{$lkp_travel_method->TRAVEL_METHOD_ID}}" name="travelMethod" />{{$lkp_travel_method->TRAVEL_METHOD_AR}} </label>
                                        </div>
                            			@endforeach
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('travelMethod')}}@endif</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.programLevel')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                     <select name="programLevel" class="form-control">
									<option value="">{{ trans('programm.programLevel') }}</option>
                                     @foreach ($lkp_program_levels as $lkp_program_level)
                                        <option value="{{ $lkp_program_level->PROGRAM_LEVEL_ID }}">{{ $lkp_program_level->PROGRAM_LEVEL_AR }}</option>                                                                               	@endforeach

                                    </select>
									<label class="errorform"> @if(count($errors) > 0) {{$errors->first('programLevel')}}@endif</label> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.containtiket')}}<span class="errorform">*</span></label>
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
                                        <label class="col-md-3 control-label" >{{trans('programm.containVisa')}}<span class="errorform">*</span></label>
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
                                        <label class="col-md-3 control-label" >{{trans('programm.travelDate')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                        <input name="travelDate" placeholder="{{trans('programm.travelDate')}}"  class="date-pick form-control" data-date-format="yyyy-mm-dd" type="text" value="{{Request::old('travelDate')}}" id="date-pick-b-d" />
                                           <label class="errorform"> @if(count($errors) > 0) {{$errors->first('travelDate')}}@endif</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.travelDateHijri')}}</label>
                                          <div class="col-md-6">
                                        <input name="travelDateHijri" placeholder="{{trans('programm.travelDateHijri')}}"  class="form-control input-md"  type="text" value="{{Request::old('travelDateHijri')}}" id="date-pick-b-d-hijiry" disabled="disabled" />
                                           <label class="errorform"> @if(count($errors) > 0) {{$errors->first('travelDateHijri')}}@endif</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.returnDate')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                        <input name="returnDate" placeholder="{{trans('programm.returnDate')}}"  class="date-pick form-control" data-date-format="yyyy-mm-dd" type="text" value="{{Request::old('returnDate')}}" id="date-pick-s-d" />
                                           <label class="errorform"> @if(count($errors) > 0) {{$errors->first('returnDate')}}@endif</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.returnDateHijri')}}</label>
                                          <div class="col-md-6">
                                        <input name="returnDateHijri" placeholder="{{trans('programm.returnDateHijri')}}"  class="form-control input-md"  type="text" value="{{Request::old('returnDateHijri')}}" id="date-pick-s-d-Hijri" disabled="disabled" />
                                           <label class="errorform"> @if(count($errors) > 0) {{$errors->first('returnDateHijri')}}@endif</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.gateDiscount')}}</label>
                                          <div class="col-md-5">
                                        <input name="gateDiscount" placeholder="{{trans('programm.gateDiscount')}}"  class="form-control input-md"  type="number" value="{{Request::old('gateDiscount')}}" />
                                           <label class="errorform"> @if(count($errors) > 0) {{$errors->first('gateDiscount')}}@endif</label>
                                        </div>
                                        <div class="col-md-1">%</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.takseetAllowed')}}</label>
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
                                        <label class="col-md-3 control-label" >{{trans('programm.ryalExchangeRate')}}</label>
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
                                        <label class="col-md-3 control-label" >{{trans('programm.ticketExchangeRate')}}</label>
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
                            <input class="btn btn-primary" type="submit" name="submit" value="{{ trans('programm.steptwo') }}" />

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
<script language="javascript">
$(document).ready(function(){
	$('#date-pick-b-d').on('change',function(){
		var date=$('#date-pick-b-d').val();
		$.ajax({
			url:'{{URL::to("/Hijri_GregorianTest.php")}}',
			dataType:"json",
			type:'POST',
			data:{date:date},
			beforeSend: function(){
				
			},success: function(data){
			//alert(data);
			$('#date-pick-b-d-hijiry').val(data);
			},error: function(data){
				alert(data);
			}
		});
	});
		$('#date-pick-s-d').on('change',function(){
		var date=$('#date-pick-s-d').val();
		$.ajax({
			url:'{{URL::to("/Hijri_GregorianTest.php")}}',
			dataType:"json",
			type:'POST',
			data:{date:date},
			beforeSend: function(){
				
			},success: function(data){
			//alert(data);
			$('#date-pick-s-d-Hijri').val(data);
			},error: function(data){
				alert(data);
			}
		});
	});
	});
</script>
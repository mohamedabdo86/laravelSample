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
                        <div class="col-md-12 form-horizontal">
                            <h4>{{trans('programm.program_price')}}</h4>
	

<?php /*?>                           {!! Form::open(['method'=>'POST','class'=>'form-horizontal']) !!}
<?php */?>                         @if ($active == 'none')       
                                <div class='alert alert-danger'>
                                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                          <p>{{trans('company.notAllowed')}}</p>
                                    </div>

                                @else
<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.AGE_CATEGORY_ID')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                     <select name="AGE_CATEGORY_ID" class="form-control js-example-basic-singleeee" id="AGE_CATEGORY_ID">
									<option value="0">{{ trans('programm.AGE_CATEGORY_ID') }}</option>
                                     @foreach ($AGE_CATEGORY_IDS as $AGE_CATEGORY_ID)
                                        <option value="{{$AGE_CATEGORY_ID->AGE_CATEGORY_ID}}"
                                      >{{$AGE_CATEGORY_ID->AGE_CATEGORY_AR}}</option>                                     @endforeach

                                    </select>
									<label class="errorform" id="AGE_CATEGORY_ID_ERROR"> @if(count($errors) > 0) {{$errors->first('AGE_CATEGORY_ID')}}@endif</label>
                                     </div>
                                    </div>
<div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.PERSON_PER_ROOM')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                     <select name="PERSON_PER_ROOM" id="PERSON_PER_ROOM" class="form-control js-example-basic-singleeee">
									 <option value="">{{ trans('programm.PERSON_PER_ROOM') }}</option>
                                     <option value="1">{{trans('programm.singleRoom')}}</option>
                                      <option value="2">{{trans('programm.doubleRoom')}}</option>
                                      <option value="3">{{trans('programm.tripleRoom')}}</option>
                                      <option value="4">{{trans('programm.quadRoom')}}</option>
                                      <option value="5">{{trans('programm.moreQuadRoom')}}</option>                                    </select>
									<label class="errorform" id="PERSON_PER_ROOM_ERROR"> @if(count($errors) > 0) {{$errors->first('PERSON_PER_ROOM')}}@endif</label>
                                     </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('company.currency')}}<span class="errorform">*</span></label>
                                          <div class="col-md-6">
                                     <select name="CURRENCY_ID" id="CURRENCY_ID" class="form-control js-example-basic-singleeee">
									<option value="">{{ trans('company.currency') }}</option>
                                     @foreach ($CURRENCY_IDS as $CURRENCY_ID)
                                        <option value="{{$CURRENCY_ID->CURRENCY_ID}}"
                                       @if ($program_price) @if ($program_price->CURRENCY_ID == $CURRENCY_ID->CURRENCY_ID)  selected="selected" @endif @endif
                                      >{{$CURRENCY_ID->CURRENCY_NAME_AR}}</option>                                     @endforeach

                                    </select>
									<label class="errorform"  id="CURRENCY_ID_ERROR"> @if(count($errors) > 0) {{$errors->first('CURRENCY_ID')}}@endif</label>
                                     </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('programm.P_PRICE')}}</label>
                                          <div class="col-md-6">
                                        <input name="PRICE" id="PRICE" placeholder="{{trans('programm.P_PRICE')}}"  class="form-control input-md"  type="number" value="" />
                                        									<label class="errorform"  id="PRICE_ERROR"> @if(count($errors) > 0) {{$errors->first('PRICE')}}@endif</label>

                                        </div>
                                    </div>
                                    

                                     <input class="btn btn-primary" id="nextstepGo" type="submit" name="submit" value="{{ trans('programm.nextStep') }}" />
                                                         <div class="gap gap-small"></div>
                     <table class="table table-bordered table-striped table-booking-history">
                        <thead>
                            <tr>
                                <th>{{trans('programm.AGE_CATEGORY_ID')}}</th>
                                <th>{{trans('programm.PERSON_PER_ROOM')}}</th>
								<th>{{trans('company.currency')}}</th>
                                <th>{{trans('programm.P_PRICE')}}</th>
                                <th>{{trans('company.edit')}}</th>
                                <th>{{trans('company.delete')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($oldprices as $oldprice)
                        <tr id="{{$oldprice->PROGRAM_PRICE_ID}}"><td>{{$oldprice->AGE_CATEGORY_AR}}</td><td>{{$oldprice->PERSON_PER_ROOM}}</td><td>{{$oldprice->CURRENCY_NAME_AR}}</td><td>{{$oldprice->PRICE}}</td><td>{!!link_to('/company/program/prices/edit/'. $oldprice->PROGRAM_PRICE_ID . "/" . $id . "/" . $activityID,trans('company.edit'))!!}</td><td><input class='btn btn-primary btndelet {{$oldprice->PROGRAM_PRICE_ID}}' id='delet' type='submit' name='pricesubmit' value='{{ trans('company.delete') }}'  /></td></tr>
                        
                        @endforeach
                        </tbody>
                        </table>
                        {!!$oldprices->render()!!}
                                    @endif
<?php /*?>                                {!! Form::close() !!}
<?php */?>                   </div>

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
<script language="javascript">
$(document).ready(function(){
	$('#nextstepGo').on('click',function(){
		var AGE_CATEGORY_ID=$('#AGE_CATEGORY_ID').val();
		var PERSON_PER_ROOM=$('#PERSON_PER_ROOM').val();
		var CURRENCY_ID=$('#CURRENCY_ID').val();
		var PRICE=$('#PRICE').val();
		$.ajax({
			url:'{{URL::to("/company/addhajprog/stepfive/" . $id  . "/" . $activityID)}}',
			dataType:"json",
			type:'POST',
			data:{AGE_CATEGORY_ID:AGE_CATEGORY_ID,PERSON_PER_ROOM:PERSON_PER_ROOM,CURRENCY_ID:CURRENCY_ID,PRICE:PRICE,_token:'{!!csrf_token()!!}'},
			beforeSend: function(){
				
			},success: function(data){
			//alert(data);
			if (data['success'] != false) {
				
			var programpriceid = data['PROGRAM_PRICE_ID'];
			$("tbody").prepend("<tr id='"+data['PROGRAM_PRICE_ID']+"'><td>"+data['AGE_CATEGORY_AR']+"</td><td>"+ data['PERSON_PER_ROOM']+"</td><td>"+ data['CURRENCY_NAME_AR']+"</td><td>"+ data['PRICE']+"</td><td><a href=\"{{ asset('/company/program/prices/edit') }}/" + programpriceid + "/{{$id}}/{{$activityID}}\">{{trans('company.edit')}}</a></td><td><input class='btn btn-primary btndelet "+data['PROGRAM_PRICE_ID']+"' id='delet' type='submit' name='pricesubmit' value='{{ trans('company.delete') }}' onclick='onclickDelet("+data['PROGRAM_PRICE_ID']+")' /></td></tr>");
			$('#AGE_CATEGORY_ID_ERROR').slideUp();
			$('#CURRENCY_ID_ERROR').slideUp();
			$('#PERSON_PER_ROOM_ERROR').slideUp();
			$('#PRICE_ERROR').slideUp();
			//$('#AGE_CATEGORY_ID').val('');
			$('#PRICE').val('');
			}else {
			//var newArr =jQuery.makeArray( data )
			$('#AGE_CATEGORY_ID_ERROR').html(data['errors']['AGE_CATEGORY_ID']);
			$('#CURRENCY_ID_ERROR').html(data['errors']['CURRENCY_ID']);
			$('#PERSON_PER_ROOM_ERROR').html(data['errors']['PERSON_PER_ROOM']);
			$('#PRICE_ERROR').html(data['errors']['PRICE']);
				//alert(data['errors']['AGE_CATEGORY_ID']);
			}
			},error: function(data){
				alert(data);
			}
		});
	});
	
	});
	
$(".btndelet").on('click',function(){
	arr = $(this).attr('class').split( " " );
	var id = arr[3];
	//alert(arr[3]);
			$.ajax({
			url:'{{URL::to("/company/addhajprog/stepfivedelet" . "/" . $activityID)}}',
			dataType:"json",
			type:'POST',
			data:{id:id,_token:'{!!csrf_token()!!}'},
			beforeSend: function(){
				
			},success: function(data){
			//alert(data);
			$("#"+id).slideUp(300, function(){ $(this).remove();});
				//$("#"+id).remove();
			},error: function(data){
				alert(data);
			}

		});
		});
		function onclickDelet(id){
			//	arr = $(this).attr('class').split( " " );
	//var id = arr[3];
	//alert(arr[3]);
			$.ajax({
			url:'{{URL::to("/company/addhajprog/stepfivedelet" . "/" . $activityID)}}',
			dataType:"json",
			type:'POST',
			data:{id:id,_token:'{!!csrf_token()!!}'},
			beforeSend: function(){
				
			},success: function(data){
			//alert(data);
			$("#"+id).slideUp(300, function(){ $(this).remove();});
				//$("#"+id).remove();
			},error: function(data){
				alert(data);
			}

		});
		}

</script>
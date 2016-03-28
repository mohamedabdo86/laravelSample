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
                    <p>{{trans('company.addContactDesc')}}</p>
                       <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach

  </div> <!-- end .flash-message -->
                    <div class="gap gap-small"></div>
                    <hr>
                    <h2>{{trans('company.addContact')}}</h2>
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
                                       <label class="col-md-3 control-label">{{ trans('company.branchName') }}<span class="errorform">*</span></label>
                                    <div class="col-md-6">
									{!! Form::select('agency_branch_id', array('' => trans('company.select_branch')) + $lst_branches, '', ['class' => 'form-control','id'=>'agency_branch_id']) !!}
									<label class="errorform"> @if(count($errors) > 0) {{$errors->first('agency_branch_id')}}@endif</label>
                                    </div>
                                    </div>
                                    <div class="form-group">
									<div class="col-md-3 control-label"></div>
									<div class="col-md-6 control-label" id="agency_branchs">
									

									</div>
									</div>
                                    <hr />
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">{{ trans('company.prefcon') }}<span class="errorform">*</span></label>
                                        <div class="col-md-6">
										{!! Form::select('prefcon', array('' => trans('company.select_prefcon')) + $lst_contact_method, '', ['class' => 'form-control' ,'id'=>'select_prefcon']) !!}
										<label class="errorform"> @if(count($errors) > 0) {{$errors->first('prefcon')}}@endif</label>
                                    </div>
                                    </div>
									<div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                      <div class="col-md-6">
                                        <input class="form-control" id="prefconvalue" name="prefconValue" placeholder="{{ trans('company.prefcon') }}" type="text" value="{{Request::old('prefconValue')}}" />
                                      <label class="errorform"> @if(count($errors) > 0) {{$errors->first('prefconValue')}}@endif</label>                                    </div>
                                    </div>
									<input class="btn btn-primary" id="id_submit" type="submit" name="submit" value="{{trans('company.addContact')}}" />
                                @endif
                                {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
@include ('manasek.footer')
<script type="text/javascript">
<!--
$(document).ready(function(){
	$('#agency_branch_id').bind('change', function() {
		var agency_branch_id	= $('#agency_branch_id').val();
		var select_prefcon		= $('#select_prefcon').val();
		var prefconvalue		= $('#prefconvalue').val();
		$.ajax({
			url : '{{ URL::to("company/lst_contacts")}}',
			dataType: 'json',
				type: 'get',
				data:{agency_branch_id:agency_branch_id,select_prefcon:select_prefcon,prefconvalue:prefconvalue,_token:'{{ csrf_token() }}'},
				beforeSend : function(){},
				success : function(data){
						$("#agency_branchs").html('<ul>');
						$.each(data, function(i, field){
							$("#agency_branchs").append('<li><div class="col-md-5">' + field.CONTACT_METHOD_AR + '</div><div class="col-md-5">' +" ,  " + field.CONTACT_DETAILS + "</div></li>");
						});
						$("#agency_branchs").append('</ul>');
				},
				error : function(data){}
		});
		});
	$('#id_submit').bind('click', function() {
		var agency_branch_id	= $('#agency_branch_id').val();
		var select_prefcon		= $('#select_prefcon').val();
		var prefcon				= $('#select_prefcon').val();
		var prefconvalue		= $('#prefconvalue').val();
		$.ajax({
			url : '{{ URL::to("company/addcontactajax")}}',
			dataType: 'json',
				type: 'post',
				data:{agency_branch_id:agency_branch_id,select_prefcon:select_prefcon,prefconvalue:prefconvalue,prefcon:prefcon,_token:'{{ csrf_token() }}'},
				beforeSend : function(){},
				success : function(data){
						$("#agency_branchs").html('<ul>');
						$.each(data, function(i, field){
							$("#agency_branchs").append('<li><div class="col-md-5">' + field.CONTACT_METHOD_AR + '</div><div class="col-md-5">' +" ,  " + field.CONTACT_DETAILS + "</div></li>");
						});
						$("#agency_branchs").append('</ul>');
				},
				error : function(data){}
		});
		return false;
	});
});
//-->
</script>
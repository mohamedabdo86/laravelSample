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
                    <p>{{trans('company.editContactBranch')}} {{ $branche->BRANCH_NAME }}</p>
                       <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
    
  </div> <!-- end .flash-message -->

			<div class="gap gap-small"></div>
                    <div class="row row-wrap">
                     <table class="table table-bordered table-striped table-booking-history">
                        <thead>
                            <tr>
                                <th>{{trans('company.prefcon')}}</th>
                                <th>{{trans('company.address')}}</th>
								<th>{{trans('company.edit')}}</th>
                                <th>{{trans('company.delete')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                      @foreach ($contacts as $item)
                      <tr class="rw-{{$item->AGENCY_CONTACT_DATA_ID}}">
                                <td>{!! $item->CONTACT_METHOD_AR !!}</td>
                                <td class="td-{{$item->AGENCY_CONTACT_DATA_ID}}"><input id="inpt-{{$item->AGENCY_CONTACT_DATA_ID}}" class="form-control input-md" name="companyName" placeholder="{{trans('company.companyName')}}" type="text" size="15" value="{{$item->CONTACT_DETAILS}}"  /></td>
								<td>{!!link_to("/company/branch/edit/" . $item->AGENCY_CONTACT_DATA_ID,trans('company.edit'),array('id' => 'linkid-'.$item->AGENCY_CONTACT_DATA_ID,'data-id' => $item->AGENCY_CONTACT_DATA_ID,'class'=>'go-update'))!!}</td>
                                <td>{!!link_to("/company/branch/delete/" . $item->AGENCY_CONTACT_DATA_ID,trans('company.delete'))!!}</td>
                                                                            </tr>
                      @endforeach   
                      </tbody></table>
                    <p>*{{trans('company.showbrancDesc')}}</p>
                    <p>*{{trans('company.editBranchDesc')}}</p>
                    <p>*{{trans('company.deleteBranchDesc')}}</p>
                    </div>
                    </div>

                </div>
            </div>
        </div>


@include ('manasek.footer')
<script type="text/javascript">
<!--
$(document).ready(function(){
	$('.go-update').bind('click', function() {
		var item_id = $(this).data('id');
		var item_value	= $('#inpt-'+item_id).val();
		$.ajax({
				url : '{{ URL::to("company/update_contact")}}',
				dataType: 'json',
					type: 'post',
					data:{item_id:item_id,item_value:item_value,_token:'{{ csrf_token() }}'},
					beforeSend : function(){},
					success : function(data){
        $(this).animate({ borderColor: "#0e7796" }, 'fast');

					},
					error : function(data){	}
			});
		return false;
	});
});
//-->
</script>
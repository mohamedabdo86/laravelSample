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
                    <p>{{trans('company.showcontacts')}}</p>
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
                                <th>#</th>
                                <th>{{trans('company.branchName')}}</th>

								<th>{{trans('company.edit')}}</th>
                                <th>{{trans('company.delete')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                     

					  @foreach ($allbranches as $branch)
                      <tr>
                                <td>{!!link_to("/company/contact/edit/" . $branch->AGENCY_BRANCH_ID,$branch->BRANCH_NAME)!!}</td>
                                <td>{{$branch->ADDRESS}}</td>
								<td>{!!link_to("/company/contact/edit/" . $branch->AGENCY_BRANCH_ID,trans('company.edit'))!!}</td>
                                <td>{!!link_to("/company/contact/delete/" . $branch->AGENCY_BRANCH_ID,trans('company.delete'))!!}</td>
                                                                            </tr>
                      @endforeach   
                      </tbody></table>
                    <p>*{{trans('company.showbrancDesc')}}</p>
                    <p>*{{trans('company.editContactDesc')}}</p>
                    <p>*{{trans('company.deleteContactDesc')}}</p>
                    </div>

                </div>
            </div>
        </div>


@include ('manasek.footer')

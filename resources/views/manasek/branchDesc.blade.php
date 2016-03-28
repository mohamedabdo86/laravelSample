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
                    <p>{{trans('company.addBranchDesc')}}</p>
                       <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
    
  </div> <!-- end .flash-message -->
                    <div class="gap gap-small"></div>
                    <hr>
                    <h2>{{trans('company.addBranch')}}</h2>
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
                                        {{$companyName}}
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('company.branchName')}}</label>
                                          <div class="col-md-6">
                                        {{$branches->BRANCH_NAME}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">{{ trans('company.city') }}</label>
                                    <div class="col-md-6"> 
                                    {{$branchCity->CITY_NAME_AR}}   
                                    </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="col-md-3 control-label">{{ trans('company.area') }}</label>
                                    <div class="col-md-6"> 
                                    {{$branchArea->AREA_NAME_AR}}
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">{{ trans('company.address') }}</label>
                                        <div class="col-md-6"> 
                                        {{$branches->ADDRESS}}
</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">{{ trans('company.zipcode') }}</label>
                                        <div class="col-md-6"> 
                                        {{$branches->POSTAL_CODE}}
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">{{ trans('company.prefcon') }}</label>
                                        <div class="col-md-6"> 
                                    

                                    </div>
                                    </div>
<div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                      <div class="col-md-6">
                                       
                                    </div>   
                                                                 
                                @endif
                                                        {!! Form::close() !!}
                                                        {!!link_to("/company/branch/edit/" . $branches->AGENCY_BRANCH_ID,trans('company.edit'),['class'=>'btn btn-primary'])!!}
                                                        {!!link_to("/company/branch/delete/" . $branches->AGENCY_BRANCH_ID,trans('company.delete'),['class'=>'btn btn-primary'])!!}

                    </div>

                </div>
            </div>
        </div>


@include ('manasek.footer')

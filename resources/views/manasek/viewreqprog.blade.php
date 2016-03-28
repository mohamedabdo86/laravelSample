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
                    <h2>{{trans('company.showprograms',['activityName'=>$activityName->ACTIVITY_TYPE_AR])}}</h2>
                    <div class="row row-wrap">
                     <table class="table table-bordered table-striped table-booking-history">
                        <thead>
                            <tr>
                                <th>{{trans('company.progName')}}</th>
                                <th>{{trans('company.appName')}}</th>

                            </tr>
                        </thead>
                        <tbody>
                      @foreach ($allprograms as $programs)
                      <tr>
                                <td>{!!link_to("/company/prog/" . $programs->PROGRAM_ID,$programs->PROGRAM_NAME)!!}</td>
                                <td>{!!link_to("/company/prog/" . $programs->PROGRAM_ID,$programs->FULL_NAME)!!}</td>

                                                                            </tr>
                      @endforeach   
                      </tbody></table>
					{!! $allprograms->render() !!}
                    <p>*{{trans('company.showprogDesc')}}</p>

                    </div>

                </div>
            </div>
        </div>


@include ('manasek.footer')

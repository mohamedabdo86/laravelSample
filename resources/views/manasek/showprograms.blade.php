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
                      @if (count($errors)>0)


                                @foreach ($errors->all() as $error) 
                                <div class='alert alert-danger'>
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                	{!!$error!!}
                           		</div>
                                @endforeach
                            @endif
                    <div class="gap gap-small"></div>
                    <hr>
                    <h2>{{trans('company.showprograms',['activityName'=>$activityName->ACTIVITY_TYPE_AR])}}</h2>
                    <div class="row row-wrap">

                     <table class="table table-bordered table-striped table-booking-history">
                        <thead>
                            <tr>
                                <th>{{trans('company.progName')}}</th>
                                <th>{{trans('programm.stepOne')}}</th>
                                <th>{{trans('programm.steptwo')}}</th>
                                <th>{{trans('programm.stepthree')}}</th>
                                <th>{{trans('programm.stepfour')}}</th>
                                <th>{{trans('programm.stepfive')}}</th>
                                <th>{{trans('programm.publishstatus')}}</th>
                                <th>{{trans('company.delete')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                      @foreach ($allprograms as $programs)
                  <tr>
                    <td>{!!link_to("/company/showprog/" . $programs->PROGRAM_ID. "/" . $programs->PROGRAM_TYPE_ID,$programs->PROGRAM_NAME)!!}</td>
                    <td>{!!link_to("/company/prog/edit/stepOne/" . $programs->PROGRAM_ID . "/" . $programs->PROGRAM_TYPE_ID,trans('company.edit'))!!}</td>
                    <td>{!!link_to("/company/addhajprog/steptwo/" . $programs->PROGRAM_ID . "/" . $programs->PROGRAM_TYPE_ID,trans('company.edit'))!!}</td>
                    <td>{!!link_to("/company/addhajprog/stepthree/" . $programs->PROGRAM_ID . "/" . $programs->PROGRAM_TYPE_ID,trans('company.edit'))!!}</td>
                    <td>{!!link_to("/company/addhajprog/stepfour/" . $programs->PROGRAM_ID . '/3'. "/" . $programs->PROGRAM_TYPE_ID,trans('programm.Mekka'))!!}
                    <br />
                    {!!link_to("/company/addhajprog/stepfour/" . $programs->PROGRAM_ID . '/7'. "/" . $programs->PROGRAM_TYPE_ID,trans('programm.Maddina'))!!}
<br />
@if ($programs->PROGRAM_TYPE_ID == 1)
{!!link_to("/company/addhajprog/stepfour/" . $programs->PROGRAM_ID . '/9'. "/" . $programs->PROGRAM_TYPE_ID,trans('programm.Arafa'))!!}
<br />
{!!link_to("/company/addhajprog/stepfour/" . $programs->PROGRAM_ID . '/10'. "/" . $programs->PROGRAM_TYPE_ID,trans('programm.Mena'))!!}
<br />
{!!link_to("/company/addhajprog/stepfour/" . $programs->PROGRAM_ID . '/11'. "/" . $programs->PROGRAM_TYPE_ID,trans('programm.Mozdalefa'))!!}
@endif
</td>
                    <td>{!!link_to("company/addhajprog/stepfive/" . $programs->PROGRAM_ID. "/" . $programs->PROGRAM_TYPE_ID,trans('company.edit'))!!}</td>
                    <td>
                    @if ($programs->PUBLISH_PROGRAM == 1)
                    {!!link_to("/company/prog/publish/no/" . $programs->PROGRAM_ID. "/" . $programs->PROGRAM_TYPE_ID,trans('programm.unpublish'))!!}
                    @else 
                    {!!link_to("/company/prog/publish/yes/" . $programs->PROGRAM_ID. "/" . $programs->PROGRAM_TYPE_ID,trans('programm.publish'))!!}
                    @endif</td>

                    <td>{!!link_to("/company/prog/delete/" . $programs->PROGRAM_ID. "/" . $programs->PROGRAM_TYPE_ID,trans('company.delete'))!!}</td>
                 </tr>
                      @endforeach   
                      </tbody></table>
					{!! $allprograms->render() !!}
                    <p>*{{trans('company.showprogDesc')}}</p>
                    <p>*{{trans('company.editprogDesc')}}</p>
                    <p>*{{trans('company.deleteprogDesc')}}</p>
                    </div>

                </div>
            </div>
        </div>


@include ('manasek.footer')

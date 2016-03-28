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
                        <div class="col-md-12">
                            <h4>{{trans('programm.travelWayLine')}}</h4>

                           {!! Form::open(['method'=>'POST','class'=>'form-horizontal']) !!}
                         @if ($active == 'none')       
                                <div class='alert alert-danger'>
                                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                          <p>{{trans('company.notAllowed')}}</p>
                                    </div>

                                @else
                                    <div class="form-group">
                                          <div class="col-md-6">
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('programm.MekkaFirst')}}" name="travelWayLine" @if ($oldprog) @if ($oldprog->travelWayLine == trans('programm.MekkaFirst') ) checked @endif @endif /> {{trans('programm.MekkaFirst')}}</label>
                                        </div>
                                        <div class="radio-inline radio-small">
                                            <label>
                                                <input class="i-radio" type="radio" value="{{trans('programm.MadinaFirst')}}" name="travelWayLine"@if ($oldprog)  @if ($oldprog->travelWayLine ==trans('programm.MadinaFirst') ) checked @endif @endif /> {{trans('programm.MadinaFirst')}}</label>
                                        </div>
                                        <label class="errorform"> @if(count($errors) > 0) {{$errors->first('travelMethod')}}@endif</label>
                                        </div>
                                    </div>
                            <input class="btn btn-primary" type="submit" name="submit" value="{{ trans('programm.nextStep') }}" />

                                @endif
                                {!! Form::close() !!}
                   </div>

                </div>
            </div>
        </div>


@include ('manasek.footer')
@if ($active == 'yes')       
<script language="javascript">
var travelDate = "{{Request::old('travelDate')}}";
var returnDate = "{{Request::old('returnDate')}}";
$('#date-pick-b-d').datepicker('setDate', travelDate);
$('#date-pick-s-d').datepicker('setDate', returnDate);
//$('').datepicker('update', '');
</script>
@endif
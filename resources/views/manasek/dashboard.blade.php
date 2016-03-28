@include ('manasek.header')
        <div class="container">
            <h2 class="page-title">{{trans('company.profiletitle')}}</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('manasek.sidebar')
                </div>
                <div class="col-md-9">
                    <p>{{trans('company.papersDesc')}}</p>
                       <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> <!-- end .flash-message -->
                    <div class="gap gap-small"></div>
                    <hr>
                    <h2>{{trans('company.papers')}}</h2>
                    <div class="row row-wrap">
                         {!! Form::open(['method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}
                                
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('company.commercialRegister')}}</label>
                                          <div class="col-md-6">
                                        <input class="form-control input-md" name="file[]" placeholder="{{trans('company.companyEmail')}}" type="file"  />
                                            @if(count($errors) > 0) {{$errors->first('commercialRegister')}}@endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('company.license')}}</label>
                                        <div class="col-md-6">
                                        	<input class="form-control" name="file[]" placeholder="{{trans('company.license')}}" type="file" />
                                            @if(count($errors) > 0) {{$errors->first('license')}}@endif
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" >{{trans('company.saa')}}</label>
                                        <div class="col-md-6">
                                        	<input class="form-control" name="file[]" placeholder="{{trans('company.saa')}}" type="file" />
                                            @if(count($errors) > 0) {{$errors->first('saa')}}@endif
                                        </div>
                                        
                                    </div>
                                    
                                <input class="btn btn-primary" type="submit" name="submit" value="{{trans('company.uploadpapers')}}" />
                                {!! Form::close() !!}
                        
                    </div>

                </div>
            </div>
        </div>


@include ('manasek.footer')
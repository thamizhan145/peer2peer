@extends('layouts.app')

@section('content')
<div class="container" id="body_container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Dashboard</h2>
                </div>


            @if($d['acc'])

                <div class="row">
                    <div class="col-md-5  col-md-offset-1">
                        <h3>Get Help</h3>

                    @if($d['currentStatus'] == 0)
                        <h4>You Need to Provide the help to GET help</h4>
                    @elseif($d['currentStatus'] == 2)

                        @if(count($d['helpMatchGet_current']))
                            <h4>Approve the help!</h4>
                            <ul>
                                @foreach($d['helpMatchGet_current'] as $k=>$v)
                                    <li>
                                        <a href="/gethelp">{{$v->fname}} {{$v->lname}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <h4>Waiting for the match!</h4>
                        @endif
                    @endif
                    </div>

                    <div class="col-md-5  col-md-offset-1">
                        <h3>Provide Help</h3>

                    @if($d['currentStatus'] == 0)
                        <h4>You Need to Provide the help to GET help</h4>
                    @elseif($d['currentStatus'] == 1)
                        
                        @if(count($d['helpMatchProvide_current']))
                            <h4>Provide the help!</h4>
                            <ul>
                                @foreach($d['helpMatchProvide_current'] as $k=>$v)
                                    <li>
                                        <a href="/providehelp">{{$v->fname}} {{$v->lname}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <h4>Waiting for the match!</h4>
                        @endif

                    @else
                        <h4>Nothing to Process!</h4>
                    @endif                      
                    </div>
                </div> 
            @else

                <div class="alert alert-danger">
                    <span>Please Add your account details.</span>
                </div>
            @endif
            </div>
        </div>

        <div class="col-md-3">
            
            <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading">
                  <h3>Testimonials</h3>
              </div>
              <!-- List group -->
              <ul class="list-group">
                @foreach($d['tm'] as $k=>$v)
                    <li class="list-group-item">
                        <p>{{$v->content}}</p> 
                        <span><i> - {{$v->fname}} {{$v->lname}}</i></span>   
                    </li>
                @endforeach
              </ul>
            </div>

        </div>
    </div>
<!-- <pre>
    {{print_r($d)}}
</pre>
 -->
</div>
@endsection
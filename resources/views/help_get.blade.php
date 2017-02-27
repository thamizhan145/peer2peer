@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Get help</h3>
                </div>
                <div class="panel-body">
                    
                

                    @if(!$d['isAcceptProvidedHelp'] && !$d['currentStatus'])
                        <p>To get help,<br />You need to provide the help to some one.</p>
                        <a href="/providehelp" class="btn btn-primary btn-lg">Provide Help</a>

                    @elseif(!$d['isAcceptGetHelp'])
                        <p>By clicking the Submit button,<br />
                        I confirm that I agree with the Terms and conditions of This community. Else, Click the Cancel button to exit.</p>

                        <form method="post" action="/acceptGetHelp">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary btn-lg" role="button">Submit</button>
                            <button class="btn btn-default btn-lg" role="button">Cancel</button>
                        </form>



                    @elseif(count($d['helpMatchGet']))
                        <p>List the Members Here,<br />
                        <div class="row">
                        @foreach($d['helpMatchGet'] as $k=>$v)
                        

                            <div class="col-md-4">
                                <div class="panel panel-info" >
                                    <div class="panel-heading">
                                        <h4 class="panel-title">PAYER {{$k+1}}</h4>
                                    </div>
                                    <div class="panel-body">
                                        <p>
                                            PAYER’S NAME : {{$v->fname}} {{$v->lname}}<br />
                                            PHONE NUMBER : {{$v->phoneno}}<br />                
                                        </p>

                                        <div>                                        
                                            @if($v->proof)
                                                <a target="_blank" href="/proofimages/{{$v->proof}}">View Receipt</a>

                                                @if($v->receiver_ack == 0)
                                                    <div>

                            <form action="/ackTheHelp" method="POST">
                                {{csrf_field()}}

                                <input type="hidden" name="sender_id" value="{{$v->sender_id}}">
                                <input type="hidden" name="help_id" value="{{$v->help_id}}">
                                                                
                                Did you receive the money ?
                                <button type="submit" class="btn btn-info">Yes</button>
                                <button type="button" class="btn btn-default">No</button>
                            </form>

                                                </div>
                                                @elseif($v->receiver_ack == 1)
                                                    <div class="alert alert-success">
                                                        <span>You have confirmed</span>
                                                    </div>
                                                @elseif($v->receiver_ack == 2)
                                                    <div class="alert alert-danger">
                                                        <span>You have Declined!</span>
                                                    </div>
                                                @endif

                                            @else
                                                <p>Receipt Not Yet Uploaded!</p>
                                            @endif
                                        </div>

                                    </div>
                                </div>                        
                            </div>
                        

                        @endforeach
                           </div> 
                        </p>

                    @elseif(count($d['helpMatchGet']) == 0)
                        <p>Yet to find the match !,<br />
                            <h3>Pls Wait!</h3>
                        </p>
                    @endif




              
                </div>

            </div>
        </div>
    </div>

    <pre>
    {{print_r($d)}}
    </pre>


</div>
@endsection
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
                            
                            <a href="/home" class="btn btn-default btn-lg">Cancel</a>
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
                                    <input type="submit" name="submit" class="btn btn-info" value="Yes">
                                    <input type="submit" name="submit" class="btn btn-default" value="No">
                                </form>

                            </div>
                            @elseif($v->status == 2)
                                <div class="alert alert-success">
                                    <span>You have confirmed</span>

                                    
                                </div>
                                <a href="#" data-toggle="modal" onClick="setHelp({{ $v->help_id }})" data-target="#testimonial" title="Make this member to get help">Write Testimonial</a>

                            @elseif($v->status == 3)
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


<!-- Modal -->
<div class="modal fade" id="testimonial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Write your testimonial</h4>
      </div>
      <div class="modal-body">

        <form id="form_Testimo" class="form-group">
            {{csrf_field()}}
            <input type="hidden" name="hid" id="hid">

            <div class="form-group">
                <textarea class="form-control" name="msg" id="msg" rows="3" cols="10" required="" minlength="10"></textarea>
            </div>



            <div class="form-group">
                <button type="submit" id="addTestimonial" class="btn btn-primary">Submit</button>                
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                <span style="display: none;"  class="alert alert-success" role="alert" id="Msg_Sucess">Added Successfully!!</span>
                <span style="display: none;"   class="alert alert-danger" role="alert" id="Msg_Failure">Please Try again later !!</span>
                

            </div>

        </form>
      </div>

    </div>
  </div>
</div>

 <!-- <pre>
    {{print_r($d)}}
</pre>
 -->

</div>
@endsection
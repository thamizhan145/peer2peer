@extends('layouts.app')

@section('content')
<div class="container" ng-controller="HelpCtrl" >
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Provide Help</h3>
                </div>
                <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">


                        @if($d['currentStatus'] == 2)
                            <p class="alert alert-info">
                                You have provided the help.
                                <h2>You are eligible to get the help now!</h2>
                            </p>
                        @elseif(!$d['isAcceptProvidedHelp'])
                            
                            <div class="alert alert-warning">
                                <strong>Note :</strong>Please be sure that you have the money you Pledging ready because You may be matched the Next morning.
                            </div>

                            <div class="alert alert-info">
                                By clicking the Submit button, <br />

                                <p>
                                    I confirm that I agree with the Terms and conditions of This community. Else, Click the Cancel button to exit.
                                </p>

                                <div class="form-group">
                                    <form method="post" action="/acceptProvideHelp">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary btn-lg" role="button">Submit</button>
                                        <a href="/home" class="btn btn-default btn-lg">Cancel</a>
                                    </form>                                
                                </div>
                            </div>

                        @elseif(count($d['helpMatchProvide_current']))

                            <p>Provide Your help to the following member !,<br />
                                <h3>Upload the Proof!</h3>
                            </p>

                            @foreach($d['helpMatchProvide_current'] as $k=>$v)

                                @if($v->status == 2)
                                    <div class="panel panel-success">
                                @elseif($v->status == 3)
                                    <div class="panel panel-danger">
                                @else
                                    <div class="panel panel-info">
                                @endif

                                <div class="panel-heading">
                                    <h4 class="panel-title">Your Match
                                        @if($v->status != 1)
                                             - This help is Over
                                        @endif
                                    </h4>
                                </div>
                                <div class="panel-body">

                                    <h3>PLEASE PAY 25,000 TO</h3>

                                    <p>
                                        ACCOUNT NAME : {{$v->account_name}} <br />
                                        ACCOUNT NUMBER : {{$v->account_no}}<br />
                                        ACCOUNT TYPE : {{$v->account_type}}<br />
                                        BANK NAME : {{$v->bank_name}}<br />
                                        PHONE NUMBER : {{$v->phoneno}}<br />                                
                                    </p>

                                    <div class="alert alert-warning">
                                        <strong>Note:</strong>WITHIN 24 HRS OR RISK SUSPENSION
                                        OF YOUR ACCOUNT AND CONSEQUENTLY
                                        REMOVAL OF ALL YOUR REFFERALS
                                    </div>

                                    @if($v->proof=='')
                                    <form action="/uploadProof" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}

                                        <input type="hidden" name="help_id" value="{{$v->help_id}}">

                                        <div class="form-group">
                                            <label for="file_proof">Upload the Proof:</label>
                                            
                                            <input id="file_proof" accept=".jpg,.png" class="form-control" type="file" name="file_proof" required="">
                                        </div>
                                            
                                        <div class="form-group">
                                            <button type="submit" ng-click="uploadForm()" class="btn btn-info">Upload</button>
                                        </div>
                                            
                                    </form>
                                    @elseif($v->proof)
                                        <a target="_blank" href="/proofimages/{{$v->proof}}">View Receipt</a>
                                    @endif

                                    @if($v->status == 2)
                                        <span class="alert alert-success">
                                            <strong>This Help is accepted!</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach

                        @elseif(count($d['helpMatchProvide_current']) == 0)
                            <p class="alert alert-info">
                                You have pledged to help, Please wait patiently as the system pairs you with another participant whom you will pay your pledge to.
                            </p>
                        @endif


                    </div>                    
                </div>


                </div>

                <!-- Completed Provided Help - History -->
                @if(count($d['helpMatchProvide_completed']))

                        <div class="row" style="margin: 10px;">
                            <div class="col-md-12 ">
                                <a onClick="">History of Provide help</a>
                            </div>
                            
                        </div>

                        <div class="row" id="History_Get" style="margin: 20px;">

                        @foreach($d['helpMatchProvide_completed'] as $k=>$v)

                                @if($v->status == 2)
                                    <div class="panel panel-success col-md-6">
                                @elseif($v->status == 3)
                                    <div class="panel panel-danger col-md-6">
                                @else
                                    <div class="panel panel-info col-md-6">
                                @endif

                                <div class="panel-heading">
                                    <h4 class="panel-title">Your Match
                                        @if($v->status != 1)
                                             - This help is Over
                                        @endif
                                    </h4>
                                </div>
                                <div class="panel-body">

                                    <h3>PLEASE PAY 25,000 TO</h3>

                                    <p>
                                        ACCOUNT NAME : {{$v->account_name}} <br />
                                        ACCOUNT NUMBER : {{$v->account_no}}<br />
                                        ACCOUNT TYPE : {{$v->account_type}}<br />
                                        BANK NAME : {{$v->bank_name}}<br />
                                        PHONE NUMBER : {{$v->phoneno}}<br />                                
                                    </p>

                                    <!-- <div class="alert alert-warning">
                                        <strong>Note:</strong>WITHIN 24 HRS OR RISK SUSPENSION
                                        OF YOUR ACCOUNT AND CONSEQUENTLY
                                        REMOVAL OF ALL YOUR REFFERALS
                                    </div> -->

                                    @if($v->proof=='')
                                    <form action="/uploadProof" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}

                                        <input type="hidden" name="help_id" value="{{$v->help_id}}">

                                        <div class="form-group">
                                            <label for="file_proof">Upload the Proof:</label>
                                            
                                            <input id="file_proof" accept=".jpg,.png" class="form-control" type="file" name="file_proof" required="">
                                        </div>
                                            
                                        <div class="form-group">
                                            <button type="submit" ng-click="uploadForm()" class="btn btn-info">Upload</button>
                                        </div>
                                            
                                    </form>
                                    @elseif($v->proof)
                                        <a target="_blank" href="/proofimages/{{$v->proof}}">View Receipt</a>
                                    @endif

                                    @if($v->status == 2)
                                        <span class="alert alert-success">
                                            <strong>This Help is accepted!</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        @endforeach
                           </div>

                    @endif

                    



            </div>


        </div>


        


    </div>

<!-- <pre>
    {{print_r($d)}}
</pre>
 -->

</div>
@endsection
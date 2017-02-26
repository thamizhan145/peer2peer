@extends('layouts.app')

@section('content')
<div class="container" ng-controller="HelpCtrl" >
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Provide help</h3>
                </div>
                <div class="panel-body">
                <div class="col-md-8 col-md-offset-2">


                    @if(!$d['isAcceptProvidedHelp'])
                        
                        <div class="alert alert-info">
                            <strong>Note :</strong>Please be sure that you have the money you Pledging ready because You may be matched the Next morning.
                        </div>

                        <p>By clicking the Submit button, <br />I confirm that I agree with the Terms and conditions of This community. Else, Click the Cancel button to exit.</p>

                        <form method="post" action="/acceptProvideHelp">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary btn-lg" role="button">Submit</button>
                            <button class="btn btn-default btn-lg" role="button">Cancel</button>
                        </form>

                        
                        


                    @elseif(count($d['helpMatchProvide']))
                        <p>Provide Youe help to the following member !,<br />
                            <h3>Upload the Proof!</h3>
                        </p>

                        @foreach($d['helpMatchProvide'] as $k=>$v)

                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title">Your Match</h4>
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
                                @endif


                                 

                            </div>
                        </div>
                        @endforeach

                    @elseif(count($d['helpMatchProvide']) == 0)
                        <p>Yet to find the match !,<br />
                            <h3>Pls Wait!</h3>
                        </p>
                    @endif


                </div>

                </div>

            </div>
        </div>
    </div>

<pre>
{{print_r($d)}}
</pre>

</div>
@endsection
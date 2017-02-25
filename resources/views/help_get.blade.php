@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Get help</h3>
                </div>
                <div class="panel-body">
                <div class="col-md-8 col-md-offset-2"  ng-show="account_info">
                    
                    <p>By clicking the Submit button,<br />
I confirm that I agree with the Terms and conditions of This community. Else, Click the Cancel button to exit.</p>
                

                <button class="btn btn-primary btn-lg" role="button">Accept</button>


                </div>


                </div>

            </div>
        </div>
    </div>


</div>
@endsection
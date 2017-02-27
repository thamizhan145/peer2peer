@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Add Account Info</h3>
                </div>
                <div class="panel-body">

                <div>
                        <form class="form-horizontal"  method="post" role="form" action="/account/add">
                        {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('account_name') ? ' has-error' : '' }}">
                                <label for="account_name" class="col-md-4 control-label">Account Name</label>

                                <div class="col-md-6">
                                    <input id="account_name" type="text" class="form-control" name="account_name" value="{{ old('account_name') }}" autofocus>

                                    @if ($errors->has('account_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('account_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            
                            <div class="form-group{{ $errors->has('account_no') ? ' has-error' : '' }}">
                                <label for="account_no" class="col-md-4 control-label">Account No.</label>

                                <div class="col-md-6">
                                    <input id="account_no" type="text" class="form-control" name="account_no" value="{{ old('account_no') }}" autofocus>

                                    @if ($errors->has('account_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('account_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('account_type') ? ' has-error' : '' }}">
                                <label for="account_type" class="col-md-4 control-label">Account Type</label>

                                <div class="col-md-6">
                                    <input id="account_type" type="text" class="form-control" name="account_type" value="{{ old('account_type') }}" autofocus>

                                    @if ($errors->has('account_type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('account_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <label for="bank_name" class="col-md-4 control-label">Bank Name</label>

                                <div class="col-md-6">
                                    <input id="bank_name" type="text" class="form-control" name="bank_name" value="{{old('bank_name') }}" autofocus>

                                    @if ($errors->has('bank_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('bank_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <!-- ng-click="saveAccount()"  -->
                        </form>                        
                    </div>



                </div>

            </div>
        </div>
    </div>


</div>
@endsection
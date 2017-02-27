@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Account Info</h3>
                </div>
                <div class="panel-body">
                <div class="col-md-8 col-md-offset-2">
                    <p><strong>Account Name : </strong><span>{{$acc->account_name}}</span></p>
                    <p><strong>Account No : </strong><span>{{$acc->account_no}}</span></p>
                    <p><strong>Account Type : </strong><span>{{$acc->account_type}}</span></p>
                    <p><strong>Bank Name : </strong><span>{{$acc->bank_name}}</span></p>

                    <a href="/account/edit" class="btn btn-info">Edit</a>
                    <!-- ng-click="show_edit_account()"  -->
                </div>


                </div>

            </div>
        </div>
    </div>


</div>
@endsection
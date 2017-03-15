@extends('layouts.app')

@section('content')
<div class="container" id="body_container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>My Profile</h3>
                </div>
                <div class="panel-body">
                <div class="col-md-8 col-md-offset-2">
                    <p><strong>First Name : </strong><span>{{$d->fname}}</span></p>
                    <p><strong>Last Name : </strong><span>{{$d->lname}}</span></p>
                    <p><strong>Email Address : </strong><span>{{$d->email}}</span></p>
                    <p><strong>Phone.No : </strong><span>{{$d->phoneno}}</span></p>
                    <p><strong>Referrer Email : </strong><span>{{$d->remail}}</span></p>
                    <p><strong>Role : </strong>
                        
                            @if($d->role == 1)
                                <span>Admin</span>        
                            @else
                                <span>Member</span>        
                            @endif
                    </p>
                    <p><strong>Status : </strong>
                        
                            @if($d->status == 1)
                                <span>Active</span>        
                            @elseif($d->status == 2)
                                <span>Suspended</span>        
                            @endif
                    </p>

                    <!-- <a href="/account/edit" class="btn btn-info">Edit</a> -->
                    <!-- ng-click="show_edit_account()"  -->
                </div>


                </div>

            </div>
        </div>
    </div>


</div>
@endsection
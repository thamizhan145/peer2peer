@extends('layouts.app')

@section('content')
<div class="container" id="body_container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>My Referreals</h3>
                </div>
                <div class="panel-body">

                    <table id="my_ref" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($d as $k=>$u)
                            <tr>
                            <td>{{$u->fname}}</td>
                            <td>{{$u->email}}</td>
                                <td>
                                    @if($u->status == 1)
                                        <span>Completed</span>
                                    @elseif($u->is_rejected == 1)
                                        <span>Rejected</span>
                                    @elseif($u->status == 0 && $u->is_paid == 1)
                                        <span>Waiting for 5 referrals</span>
                                    @elseif($u->status == 0 && $u->is_paid == 0)
                                        <span>Member Yet to Pay</span>
                                    @else
                                        <span> - </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<h3>Members List</h3>
                </div>
                <div class="panel-body">
 
                <table class="table table-striped">
                	<thead>
                		<th>Name</th>
                		<th>Email</th>
                		<th>PhoneNo</th>
                		<th>Status</th>
                		<th>Help</th>
                		<th>Action</th>
                	</thead>
                	<tbody>

	                	@foreach ($u as $k=>$user)
	                	<tr>
						    <td>

						    	{{ $user->fname }} {{ $user->lname }}

								@if($user->role == '1')
						    		<label class="label label-primary">Admin</label>
						    	@endif

						    </td>
						    <td>{{ $user->email }}</td>
						    <td>{{ $user->phoneno }}</td>
						    <td>

						    	@if($user->status == '1')
						    		<label class="label label-success">Active</label>
						    	@elseif($user->status == '2')
						    		<label class="label label-warning">Suspended</label>
						    	@endif

						    	{{ $user->status }}

						    </td>
						    <td>
						    	<button  class="btn btn-xs btn-success" title="Make this member to get help">Get</button>
						    </td>
						    <td>

							    @if($user->status == '1')
							    	<button class="btn btn-xs btn-warning">De-Activate</button>
							    @elseif($user->status == '2')
							    	<button class="btn btn-xs btn-success">Activate</button>
							    @endif
							    <button class="btn btn-xs btn-danger">Delete</button>
							</td>
						</tr>
						@endforeach  
						
                	</tbody>


                </table>

                {{$u->links()}}
					 

                </div>

            </div>
        </div>
    </div>


</div>
@endsection
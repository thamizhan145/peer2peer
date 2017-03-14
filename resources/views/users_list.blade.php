@extends('layouts.app')

@section('content')
<div class="container" ng-controller="HelpCtrl"  id="body_container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<h3>Members List</h3>
                </div>
                <div class="panel-body">


				    <table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
				        <thead>
				            <tr>
		                		<th>Name</th>
		                		<th>Email</th>
		                		<th>PhoneNo</th>
		                		<th>Status</th>
		                		<th>Help</th>
		                		<th>Action</th>
				            </tr>
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
						    	</td>
				                <td>
				                	<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" onClick="setuser({{ $user->id }})" data-target="#myModal" title="Make this member to get help">Get</button>
				                </td>
				                <td>
					                @if($user->status == '1')
					                	<form method="post" action="/suspendAccount">
					                		{{csrf_field()}}
					                		<input type="hidden" name="uid" value="{{$user->id}}">
					                		<button type="submit" class="btn btn-xs btn-warning">De-Activate</button>
					                	</form>
								    	
								    @elseif($user->status == '2')
								    	<form method="post" action="/activateAccount">
					                		{{csrf_field()}}
					                		<input type="hidden" name="uid" value="{{$user->id}}">
					                		<button type="submit" class="btn btn-xs btn-success">Activate</button>
					                	</form>
								    @endif

							    	<!-- <form method="post" action="/deleteAccount">
				                		{{csrf_field()}}
				                		<input type="hidden" name="uid" value="{{$user->id}}">
				                		<button type="submit" class="btn btn-xs btn-danger">Delete</button>
				                	</form> -->
							    </td>
				            </tr>
				            @endforeach
				        </tbody>

				    </table>

                	<div>
                		<h3 style="color: green;display: none;" id="MHSuccessMsg"> Get Help Success! </h3>
                		<h3 style="color: red;display: none;" id="MHFailureMsg"> Get Help Failure! </h3>
                	</div>
                </div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Assign Help</h4>
      </div>
      <div class="modal-body">

      	<form class="form-group">
      		{{csrf_field()}}
      		<input type="hidden" name="Uid" id="Uid">
      		<label for="helpnum">Select No.Of Help</label>
      		<div class="form-group">
	      		<select id="helpnum" name="helpnum" class="form-control">
		      		@for ($i = 1; $i < 10; $i++)
					    <option value="{{$i}}">{{$i}}</option>
					@endfor      			
	      		</select>      			
      		</div>

      		<div class="form-group">
				<button type="button" id="getHelp" class="btn btn-primary">Get Help</button>      			
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

				<span style="display: none;"  class="alert alert-success" role="alert" id="Msg_Sucess">Help Assigned Successfully!!</span>
				<span style="display: none;"   class="alert alert-danger" role="alert" id="Msg_Failure">Problem with Assign Help!!</span>
				

      		</div>

<!-- 			<div class="modal-footer">

			</div> -->

      	</form>
      </div>

    </div>
  </div>
</div>


            </div>
        </div>
    </div>


</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container" ng-controller="HelpCtrl"  id="body_container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<h3>Matching</h3>
                </div>
                <div class="panel-body">

                	<div class="row">
		                <div class="panel panel-info col-md-6">
		                    <div class="panel-heading">
		                        <h4 class="panel-title">Get Help</h4>
		                    </div>
		                    <div class="panel-body">

		                        @foreach($d['Get'] as $k=>$v)
		                        	<p class="line-brk">
                					<input class="get" name="get" data-c="{{$v->eligible_for}}" type="checkbox" value="{{$v->member_id}}">
                					{{title_case($v->fname)}} {{title_case($v->lname)}} ({{$v->eligible_for}})
                					</p>
                				@endforeach

		                    </div>
		                </div>

		               	<div class="panel panel-info col-md-6">
		                    <div class="panel-heading">
		                        <h4 class="panel-title">Provide Help</h4>
		                    </div>
		                    <div class="panel-body">

		                        @foreach($d['Provide'] as $k=>$v)

		                        <p class="line-brk">
                					<input class="provide" name="provide" type="checkbox" value="{{$v->member_id}}">
                					{{title_case($v->fname)}} {{title_case($v->lname)}}
                				</p>
                				@endforeach

		                    </div>
		                </div>

		            </div>

		            <div class="form-group">
		            	<form name="MatchingForm">
		            		{{csrf_field()}}
		            		<button type="button" id="MatchUsrM" class="btn btn-primary">Match</button>
		            	</form>
						
						<form name="autoMatchingForm" method="post" action="/autoMatch">
		            		{{csrf_field()}}
		            		<button type="submit" class="btn btn-success">Auto Match</button>
		            	</form>


		            </div>
		            <div class="panel-body">


		        <span style="display: none;"  class="alert alert-success" role="alert" id="Msg_Sucess">Help Matched Success!</span>
				<span style="display: none;"   class="alert alert-danger" role="alert" id="Msg_Sucess">Problem with Assign Help!!</span>
                	
<!-- 
                	<pre>
                		{{print_r($d)}}	
                	</pre> -->
 					
					 

                </div>

            </div>
        </div>
    </div>


</div>
@endsection
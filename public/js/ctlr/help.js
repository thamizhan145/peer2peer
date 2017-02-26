function acceptPH(argument) {

	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	$.ajax({
	    url: '/acceptProvideHelp',
	    type: 'POST',
	    data: {_token: CSRF_TOKEN},
	    dataType: 'JSON',
	    success: function (data) {
	        console.log(data);
	    }
	});

}

function HelpCtrl ($scope, httpCall, $timeout, $filter, filteredListService, ngDialog) {


	$scope.setToken = function(t){
		$scope.Token = t;
	};

	$scope.MHSuccessMsg = false;
	$scope.MHFailureMsg = false;

	$scope.setToGet = function(uid){

		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

		$.ajax({
		    url: '/makeMemberToGetHelp',
		    type: 'POST',
		    data: {_token: CSRF_TOKEN, 'id' : uid},
		    dataType: 'JSON',
		    success: function (data) {
		       console.log(data);
		       console.log($scope.MHSuccessMsg, data['d']['Success']);
		       if(typeof data['d']['Success'] != 'undefined'){
	       			$('#MHSuccessMsg').show();
					
		       }else{
		       		$('#MHFailureMsg').show();
		       	
		       }

		       console.log($scope.MHSuccessMsg);

		       setTimeout(function(){
			       	$('#MHFailureMsg').hide();
					$('#MHSuccessMsg').hide();
				}, 2000);

		    }
		});


	};
}
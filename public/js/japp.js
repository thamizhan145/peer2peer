$(document).ready(function() {
	console.log('DOM Ready');

	$('#example').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0]+' '+data[1];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
    });

});


$("#form_Testimo").submit(function(){

	console.log('On Click !!');

	var ReqData = {
		"_token": window.Laravel['csrfToken'],
		"hid": $("#hid").val(),
		"msg": $("#msg").val()
	};

	$.ajax({
	    url: '/addTestimonial',
	    type: 'POST',
	    data: ReqData,
	    dataType: 'JSON',
	    success: function (data) {
	        console.log(data);
	        if(data['success']){
	        	$('#Msg_Sucess').show();
	        	$("#msg").val('')
	        }else{
	        	$('#Msg_Failure').show();
	        }

	    }
	});

});


// function addTestimonial() {
	
// }

function setHelp(id) {
	$('#hid').val(id);
}

function setuser(id) {
	$('#Uid').val(id);
}

$(document).on('click','#getHelp', function() {
	console.log('On Click !!');

	var ReqData = {
		"_token": window.Laravel['csrfToken'],
		"uid": $("#Uid").val(),
		"Nofhelp": $("#helpnum").val()
	};

	$.ajax({
	    url: '/makeMemberToGetHelp',
	    type: 'POST',
	    data: ReqData,
	    dataType: 'JSON',
	    success: function (data) {
	        console.log(data);

	        if(data['d']['Success']){
	        	$('#Msg_Sucess').show();
	        }else{
	        	$('#Msg_Failure').show();
	        }

	    }
	});

});

function rmEle(arr,val) {

	var index = arr.indexOf(val);
	if (index > -1) {
	    arr.splice(index, 1);
	}

	return arr;
}

var MatchP =  [];
var MatchG =  [];

var getLimit = 1;
var provideLimit = 0;
$('input.get').on('change', function(evt) {
	
	var getHelpLen = $('input.get:checked').length;
	if(getHelpLen){

		if(getHelpLen > getLimit) {
			console.log('Get Limit Over !!');
			this.checked = false;
		}else{

			provideLimit = $('input.get:checked').data('c');
			
			if($(this).is(':checked')){
				MatchG.push($(this).val());
			}else{
				MatchG = rmEle(MatchG, $(this).val());
			}
			

			console.log('-----Valid-------', 'Click on Get!', $(this).is(':checked'), provideLimit, MatchG);
		}
	}else{
		provideLimit = 0;
		MatchG =  [];
		console.log('-----Set Zero-------', 'Click on Get!',provideLimit);

	}
});


$('input.provide').on('change', function(evt) {
	
	var provideHelpLen = $('input.provide:checked').length;
	// console.log('----- Get Help provideHelpLen -------', provideHelpLen, provideLimit);

	if(provideLimit>0){

		if(provideHelpLen > provideLimit) {
			console.log('Provide Limit Over !!');
			this.checked = false;
		}else{

			if($(this).is(':checked')){
				MatchP.push($(this).val());
			}else{
				MatchP = rmEle(MatchP, $(this).val());
			}

			console.log('-----Valid-------', 'Click on Provide!', provideLimit, MatchP);
		}
	}else{
		this.checked = false;
		alert('Please select the "Get Help Member" !!')
	}
});

$(document).on('click','#MatchUsrM', function() {
	console.log('On Click !!', MatchP.length, MatchG[0]);
	// Validate the User Counts
	if(provideLimit != 0 && MatchP.length == provideLimit){

		console.log('Its Okay !!');
		// return false;

		var ReqData = {
			"_token": window.Laravel['csrfToken'],
			"p": MatchP.join(),
			"g": MatchG.join()
		};

		$.ajax({
		    url: '/MatchUser',
		    type: 'POST',
		    data: ReqData,
		    dataType: 'JSON',
		    success: function (data) {
		        console.log(data);

		        if(data['Success']){
		        	$('#Msg_Sucess').show();
		        	setTimeout(function() {
		        		location.reload();	
		        	}, 3000);

		        	
		        }else{
		        	$('#Msg_Failure').show();
		        }
		    }
		});		
	}else{
		console.log(MatchP, MatchG)
		alert('Please check the count !!');
	}
	
	

});





// $(document).on('click', '.provide', function(e) {
	
// 	var pro = $(this).val();
// 	MatchP.push(pro);
// 	$('#provide_user').val(MatchP);

// });

// $(document).on('click', '.get', function(e) {

// 	var get = $(this).val();
// 	MatchG.push(get);
// 	$('#get_user').val(MatchG);
// });



/*
$(document).on('click', '.provide', function(e) {

	if(typeof Match['get'] != 'undefined'){

		if(Match['get'].length > 0){
			var u = $(this).val();
			
			if($(this).prop("checked") == true){
				console.log('Checked !!');
				$('.provide').attr('disabled', true);
				$(this).attr('disabled', false);

				console.log(' HERE val', u);

			}else{
				$('.provide').attr('disabled', false);
			}			
		}else{
			console.log('No Values');
		}

	}else{
		console.log('Please select the GET Help!');
		alert('Please select the GET Help!');
		e.preventDefault();
	}	



});


 
$(document).on('click', '.get', function(e) {

	var u = $(this).val();

	if(typeof Match['get'] != 'undefined'){

		if(Match['get'].length > 0){
			
			if($(this).prop("checked") == true){
				console.log('Checked !!');

				$('.get').attr('disabled', true);
				$(this).attr('disabled', false);

				console.log(' HERE val', u);

			}else{
				$('.get').attr('disabled', false);
				
				var array = Match['get'];
				var index = array.indexOf(u);

				if (index > -1) {
				    array.splice(index, 1);
				}

			}			
		}else{
			
			Match['get'].push(u);

			console.log('No Values');
		}

	}else{
		
		if($(this).prop("checked") == true){
			Match['get'] = [];
			Match['get'].push(u);

			// Disable Other GET // Enable Only This
			$('.get').attr('disabled', true);
			$(this).attr('disabled', false);

		}else{

			var array = Match['get'];
			var index = array.indexOf(u);

			if (index > -1) {
			    array.splice(index, 1);
			}

		}


	}	


	console.log('Match : ', Match);



});

*/
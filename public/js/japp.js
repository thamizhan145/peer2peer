
$(document).ready(function() {
	
	console.log('DOM Ready');

 
});


var MatchP =  [];
var MatchG =  [];

$(document).on('click', '.provide', function(e) {
	
	var pro = $(this).val();
	MatchP.push(pro);
	$('#provide_user').val(MatchP);

});

$(document).on('click', '.get', function(e) {

	var get = $(this).val();
	MatchG.push(get);
	$('#get_user').val(MatchG);
});



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
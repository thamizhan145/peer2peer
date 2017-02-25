function HelpCtrl ($scope, $timeout, $filter, filteredListService, ngDialog) {

	$scope.accepted_help = true;
	$scope.my_match = false;
	$scope.upload_proof = false;

	$scope.provide_accept = function(){
		$scope.accepted_help = false;
		$scope.my_match = true;
	}	

	$scope.uploadForm = function(){
		$scope.upload_proof = true;
	}

	$scope.uploadProof = function(){
		$scope.accepted_help = false;
		$scope.my_match = false;
		$scope.upload_proof = false;
		$scope.proof_yet_accept = true;
	}


	// Get Help

	$scope.pay_confirm = false;
	$scope.getHelpAcceptMsg = true;

	$scope.getHelp = function(){
		$scope.getHelpAcceptMsg = false;
		$scope.pay_confirm = true;
	}

	// Help 1
	$scope.received1 = true;
	$scope.r1_y = false;
	$scope.r1_n = false;
	$scope.received1_y = function(){
		$scope.received1 = false;
		$scope.r1_y = true;
	}


	$scope.received1_n = function(){
		$scope.received1 = false;
		$scope.r1_n = true;
	}

	// Help 2
	$scope.received2 = true;
	$scope.r2_y = false;
	$scope.r2_n = false;
	$scope.received2_y = function(){
		$scope.received2 = false;
		$scope.r2_y = true;
	}


	$scope.received2_n = function(){
		$scope.received2 = false;
		$scope.r2_n = true;
	}



	// Matching

	$scope.getHelpPpl = [
	{"id" : "123", "name" : "Peter", "helpNeed" : "2", "status" : 0},
	{"id" : "234", "name" : "Julia", "helpNeed" : "3", "status" : 0},
	{"id" : "224", "name" : "MJ", "helpNeed" : "2", "status" : 0},
	{"id" : "324", "name" : "George", "helpNeed" : "3", "status" : 0},
	{"id" : "424", "name" : "DD", "helpNeed" : "2", "status" : 0},
	{"id" : "524", "name" : "Ria", "helpNeed" : "2", "status" : 0}
	];
	
	$scope.provideHelpPpl = [
		{"id" : "1123", "name" : "Khaled", "status" : 0},
		{"id" : "2234", "name" : "Roa", "status" : 0},
		{"id" : "1224", "name" : "Komal", "status" : 0},
		{"id" : "1324", "name" : "Joe", "status" : 0},
		{"id" : "1424", "name" : "Deep", "status" : 0},
		{"id" : "1524", "name" : "Arora", "status" : 0}
	];

	$scope.success_match = false;
	$scope.matchify = function(){
		$scope.success_match = true;
	}



	// Account
	$scope.account_info = false;
	$scope.account_form = true;
	$scope.show_edit_account = function(){
		$scope.account_info = false;
		$scope.account_form = true;
	}

	$scope.saveAccount = function(){
		$scope.account_info = true;
		$scope.account_form = false;
	}



	// Account

	$scope.updateAccount = function(){

		var Pinfo = {
			'Action' : 'getMyDet',
			'id' : id
		};

		httpCall('ctrlr/Prospects.php', Pinfo).success(function(data){
			console.log(data);
			if(data){
				$scope.Events = data['Events'];
				$scope.Info = data['Info'];
				$scope.Note = data['Note'];

				$scope.Events.forEach(function(d,i){
					$scope.EventIds[d.EventID] = d.Name;
				});

				console.log($scope.EventIds);

			}

		}).error(function(data){
			console.log('setEvent() Failure : ', data);
		});

	};



}





/*
	$scope.formData = {};
	$scope['ProspInfo'] = {};
	$scope['MemInfo'] = {};
    $scope.pageSize = 4;
    $scope.reverse = false;


    $scope.$on('handle_note_change', function(event, args) {
        $scope.getMyDet($scope.WebsiteId);
    });    

    $scope.$on('handle_prospect_change', function(event, args) {
        $scope.getProspects();
    });


	$scope.resetForm = function(){
		console.log('Rest Form');
		$scope.Msg = '';
		$scope.ProspInfo = angular.copy($scope.formData);
		$scope.MemInfo = angular.copy($scope.formData);
	};


	$scope.showAttendees = function(e,t) {
		var arg = {
				"event":e, 
				"frm":"cal",
				"t" : t
			}
        $scope.$emit('Attendee_Changed', arg);
	};

    $scope.addNoteForm = function() {

    	console.log($scope.WebsiteId);

    	var info = {
    		'Events' : $scope.Events,
    		'WebsiteId' : $scope.WebsiteId
    	}
		var obj = {
			template: 'addNote',
			controller: 'ProspectIn',
			data: info
		};

		var new_dialog = ngDialog.open(obj);
    }


	$scope.setEvent = function(e) {
		$scope.eventId = e;
	
		// Add today date to createdOn
		$scope.ProspInfo['createdOn'] =  new Date();
	};


	$scope.Events = [];
	$scope.EventIds = [];
	$scope.Info = [];
	
	$scope.getMyDet = function(id) {

		$scope.WebsiteId = id;
		
		var Pinfo = {
			'Action' : 'getMyDet',
			'id' : id
		};

		httpCall('ctrlr/Prospects.php', Pinfo).success(function(data){
			console.log(data);
			if(data){
				$scope.Events = data['Events'];
				$scope.Info = data['Info'];
				$scope.Note = data['Note'];

				$scope.Events.forEach(function(d,i){
					$scope.EventIds[d.EventID] = d.Name;
				});

				console.log($scope.EventIds);

			}

		}).error(function(data){
			console.log('setEvent() Failure : ', data);
		});

	};


	$scope.checkAvail = function(t) {

		console.log($scope['ProspInfo']);

		var val = (t=='u')?$scope['ProspInfo']['Username']:$scope['ProspInfo']['Email'];
		var Uinfo = {
			"type" : t,
			"val" : val,
			"Action" : "checkAvail"
		};

	    httpCall('ctrlr/Prospects.php', Uinfo).success(function(data){
	        console.log(data);
		}).error(function(data){


			console.log('getEvents() Failure : ', data);
		});

	};

	$scope.addProspect = function(Pinfo){

		Pinfo['Action'] = 'addProspect';
		Pinfo['EventId'] = $scope.eventId;
		console.log('Pinfo',Pinfo);

		// Date Convert
		var now = Pinfo['createdOn'];
		var month = (now.getMonth() + 1);               
	    var day = now.getDate();
	    if(month < 10) 
	        month = "0" + month;
	    if(day < 10) 
	        day = "0" + day;
    	
    	var today = now.getFullYear() + '-' + month + '-' + day;
    	Pinfo['CreatedOn'] = today;

    	

		$scope.Msg = '';
		$scope.error = false;

	    httpCall('ctrlr/Prospects.php', Pinfo).success(function(data){
	        console.log(data);

	        if(data.err == 101 || data.err == 102){
	        	
	        	$scope.Msg = data['err_desc'];
	        	$scope.error = true;

	        }else if(!data.err){
	        	
	        	$scope.Msg = "New Prospects Added Successfully!";
	        	$scope.error = false;

				$timeout(function(){
					$scope.resetForm();
				},3000);

	        }else{
	        	$scope.Msg = "Problem with Add Prospects. Please Try Again!";
	        	$scope.error = true;
	        }


		}).error(function(data){
			console.log('addProspect() Failure : ', data);
		});


	}


	$scope.addMember = function(Minfo){

		console.log('Minfo',Minfo);

		var v = angular.copy(Minfo);
		var MemInfo = {
			'Action' : 'addMember',
			'eId' : $scope.eventId,
			'e' : v['Email'],
			'w' : v['WebsiteId']
		};
		console.log('MemInfo -- ',MemInfo);

		$scope.Msg = '';
		$scope.error = false;

	    httpCall('ctrlr/Prospects.php', MemInfo).success(function(data){
	        console.log(data);

	        if(data.err){
	        	
	        	$scope.Msg = data['err_desc'];
	        	$scope.error = true;

	        }else if(!data.err){
	        	
	        	$scope.Msg = "Member Added Successfully!";
	        	$scope.error = false;

				$timeout(function(){
					$scope.resetForm();
				},3000);

	        }else{
	        	$scope.Msg = "Problem with Add Member. Please Try Again!";
	        	$scope.error = true;
	        }


		}).error(function(data){
			console.log('addMember() Failure : ', data);
		});


	}


	$scope.getChapters = function(){

		var info = {"Action" : "getChapterList"};
	    httpCall('ctrlr/Prospects.php', info).success(function(data){
	        console.log(data);
	        
	        $scope.Chapters = data;
		}).error(function(data){
			console.log('getChapters() Failure : ', data);
		});


	}

	$scope.getProspects = function(){

		var info = {"Action" : "ListProspects"};
	    httpCall('ctrlr/Prospects.php', info).success(function(data){
	        console.log(data);
	        
	        $scope.allItems = data['AllProspect'];
	        $scope.EA = data['EA'];
	        $scope.Chap = data['Chaps'];
	        $scope.REI = data['REI'];

            $scope.sort('FirstName');
            $scope.sort('FirstName');


		}).error(function(data){
			console.log('getProspects() Failure : ', data);
		});
	}


    $scope.tableRowExpanded = false;
    $scope.tableRowIndexExpandedCurr = "";
    $scope.tableRowIndexExpandedPrev = "";
    $scope.storeIdExpanded = "";
    
    $scope.dayDataCollapseFn = function () {
        $scope.dayDataCollapse = [];
        for (var i = 0; i < $scope.allItems.length; i += 1) {
            $scope.dayDataCollapse.push(false);
        }
    };
    
    $scope.selectTableRow = function (index, storeId) {

		if (typeof $scope.dayDataCollapse === 'undefined') {
            $scope.dayDataCollapseFn();
        }

        if ($scope.tableRowExpanded === false && $scope.tableRowIndexExpandedCurr === "" && $scope.storeIdExpanded === "") {
            $scope.tableRowIndexExpandedPrev = "";
            $scope.tableRowExpanded = true;
            $scope.tableRowIndexExpandedCurr = index;
            $scope.storeIdExpanded = storeId;
            $scope.dayDataCollapse[index] = true;
        } else if ($scope.tableRowExpanded === true) {
            if ($scope.tableRowIndexExpandedCurr === index && $scope.storeIdExpanded === storeId) {
                $scope.tableRowExpanded = false;
                $scope.tableRowIndexExpandedCurr = "";
                $scope.storeIdExpanded = "";
                $scope.dayDataCollapse[index] = false;
            } else {
                $scope.tableRowIndexExpandedPrev = $scope.tableRowIndexExpandedCurr;
                $scope.tableRowIndexExpandedCurr = index;
                $scope.storeIdExpanded = storeId;
                $scope.dayDataCollapse[$scope.tableRowIndexExpandedPrev] = false;
                $scope.dayDataCollapse[$scope.tableRowIndexExpandedCurr] = true;
            }
        }
    };



    $scope.resetAll = function () {
        $scope.filteredList = $scope.allItems;
        $scope.currentPage = 1;
        $scope.Header = ['','',''];

    }


    $scope.search = function () {

        $scope.filteredList = filteredListService.searched($scope.allItems, $scope.searchText);
        
        if ($scope.searchText == '') {
            $scope.filteredList = $scope.allItems;
        }
        // $scope.pagination(); 
    }


    // Calculate Total Number of Pages based on Search Result
    $scope.pagination = function () { 

        $scope.itemsPerPage = $scope.pageSize;
        $scope.firstPage();
        // $scope.ItemsByPage = filteredListService.paged($scope.filteredList, $scope.pageSize);
 
    };

    $scope.setPage = function () {
        $scope.currentPage = this.n;
    };

    $scope.firstPage = function () {
        $scope.currentPage = 1;
    };

    $scope.lastPage = function () {
        $scope.currentPage = $scope.ItemsByPage.length - 1;
    };


    $scope.sort = function(sortBy){

        $scope.resetAll();  
        $scope.columnToOrder = sortBy; 
           
        //$Filter - Standard Service
        $scope.filteredList = $filter('orderBy')($scope.filteredList, $scope.columnToOrder, $scope.reverse); 

        if($scope.reverse)
             iconName = 'glyphicon glyphicon-chevron-up';
         else
             iconName = 'glyphicon glyphicon-chevron-down';
              
        if(sortBy === 'FirstName'){

            $scope.Header[0] = iconName;
        }
        else if(sortBy === 'LastName')
        {
            $scope.Header[1] = iconName;
        }
        else if(sortBy === 'Email') {
            $scope.Header[2] = iconName;

        }else if(sortBy === 'PhoneNo') {
            $scope.Header[3] = iconName;

        }else if(sortBy === 'Attendance') {
            $scope.Header[4] = iconName;

        }else {
            $scope.Header[0] = iconName;
        }
         
        $scope.reverse = !$scope.reverse;   
        
        // $scope.pagination();    
    };


	$scope.eventStateChange = function(a,b,aId){

		console.log('EventStateChange', a, b, c, $scope.filteredList[a]['Events'][b]['EventAction']);
	};

	$scope.stageChange = function(a, b, aId, eNo, type){

		var Msg = '';
		if(type == 'referOut'){
			var val = $scope.filteredList[a]['Events'][b]['refOut'];

			if(val){
				Msg = 'Are you sure to set "Refer Out"';
			}else{
				Msg = 'Are you sure to remove "Refer Out"';
			}
		}else{
			var val = $scope.filteredList[a]['Events'][b]['EventAction'];
			Msg = 'Proceed to set the status and send mail?';
		}

		var info = {
			type : type,
			MsgToShow : Msg,
			eAct : val,
			aId : aId,
			eNo : eNo
		}

		var obj = {
			template: 'stateConfirmation',
			controller: 'ProspectIn',
			data: info
		};

		var new_dialog = ngDialog.open(obj);

	};


	$scope.setREI = function(item){

		var info = {
			MsgToShow : 'Proceed to set the status and send mail?',
			REI : item['REI'],
			wId :  item['WebsiteID']
		}

		var obj = {
			template: 'REI-Status-Tpl',
			controller: 'ProspectIn',
			data: info
		};

		var new_dialog = ngDialog.open(obj);

	};


	$scope.setAdvertise = function(item){

		var info = {
			MsgToShow : 'Proceed to set the Advertise?',
			Advertise : item['Advertise'],
			wId :  item['WebsiteID']
		}

		var obj = {
			template: 'Advertise-Status-Tpl',
			controller: 'ProspectIn',
			data: info
		};

		var new_dialog = ngDialog.open(obj);

	};


	$scope.Sync = function(){
		var info = {"Action" : "SyncProsp"};
	    httpCall('ctrlr/Prospects.php', info).success(function(data){
	        console.log(data);

	        var obj = {
				template: 'syncMessge',
				controller: 'ProspectIn',
				data: {}
			};

			var new_dialog = ngDialog.open(obj);
			$scope.getProspects();

		}).error(function(data){
			console.log('Sync() Failure : ', data);
		});
	}


}


function ProspectIn (httpCall, $scope, $timeout, $filter, filteredListService, alert, ngDialog) {


	$scope.formData = {};

	$scope.resetForm = function(){
		console.log('Rest Form');
		$scope.Msg = '';
		$scope.Note = angular.copy($scope.formData);
	};

	$scope.closePop = function(){
        $scope.$emit('Prospect_Changed', {message: 'msg'});
		ngDialog.close();
	};

	$scope.saveState = function() {
		console.log('Save the state');

		var Sinfo = {
			'Action' : 'saveState',
			'type' : $scope.ngDialogData['type'],
			'eAct' : $scope.ngDialogData['eAct'],
			'aId' : $scope.ngDialogData['aId'],
			'eNo' : $scope.ngDialogData['eNo']
		};
		
		httpCall('ctrlr/Prospects.php', Sinfo).success(function(data){
	        console.log(data);

	        if(data.err){
	        	
	        	$scope.Msg = data['err_desc'];
	        	$scope.error = true;

	        }else if(!data.err){
	        	
	        	$scope.Msg = "Status Changed Successfully!";
	        	$scope.error = false;

				$timeout(function(){
                	$scope.$emit('Prospect_Changed', {message: 'msg'});
					ngDialog.close();

				},1000);

	        }else{
	        	$scope.Msg = "Problem with change status. Please Try Again!";
	        	$scope.error = true;
	        }


		}).error(function(data){
			console.log('saveState() Failure : ', data);
		});
	}

	$scope.saveREI = function() {
		console.log('Save the REI');

		var Sinfo = {
			'Action' : 'saveREI',
			'wId' : $scope.ngDialogData['wId'],
			'REI' : $scope.ngDialogData['REI']
		};
		
		httpCall('ctrlr/Prospects.php', Sinfo).success(function(data){
	        console.log(data);

	        if(data.err){
	        	
	        	$scope.Msg = data['err_desc'];
	        	$scope.error = true;

	        }else if(!data.err){
	        	
	        	$scope.Msg = "RE Interview Status Changed successfully!";
	        	$scope.error = false;

				$timeout(function(){
                	$scope.$emit('Prospect_Changed', {message: 'msg'});
					ngDialog.close();

				},1000);

	        }else{
	        	$scope.Msg = "Problem with RE Interview Status Change. Please Try Again!";
	        	$scope.error = true;
	        }


		}).error(function(data){
			console.log('saveREI() Failure : ', data);
		});
	}


	$scope.saveAdvertise = function() {
		console.log('Save the saveAdvertise');

		var Sinfo = {
			'Action' : 'saveAdvertise',
			'wId' : $scope.ngDialogData['wId'],
			'Advertise' : $scope.ngDialogData['Advertise']
		};
		
		httpCall('ctrlr/Prospects.php', Sinfo).success(function(data){
	        console.log(data);

	        if(data.err){
	        	
	        	$scope.Msg = data['err_desc'];
	        	$scope.error = true;

	        }else if(!data.err){
	        	
	        	$scope.Msg = "Advertise Status Changed successfully!";
	        	$scope.error = false;

				$timeout(function(){
                	$scope.$emit('Prospect_Changed', {message: 'msg'});
					ngDialog.close();

				},1000);

	        }else{
	        	$scope.Msg = "Problem with RE Interview Status Change. Please Try Again!";
	        	$scope.error = true;
	        }


		}).error(function(data){
			console.log('saveAdvertise() Failure : ', data);
		});
	}



    $scope.addNoteSubmit = function(Ninfo){

		Ninfo['Action'] = 'addNote';
		Ninfo['WId'] = $scope.ngDialogData['WebsiteId'];
		console.log('Ninfo',Ninfo, $scope.ngDialogData);

		$scope.Msg = '';
		$scope.error = false;

	    httpCall('ctrlr/Prospects.php', Ninfo).success(function(data){
	        console.log(data);

	        if(data.err){
	        	
	        	$scope.Msg = data['err_desc'];
	        	$scope.error = true;

	        }else if(!data.err){
	        	
	        	$scope.Msg = "New Note Added Successfully!";
	        	$scope.error = false;

				$timeout(function(){
                	$scope.$emit('Note_Changed', {message: 'msg'});
					$scope.resetForm();
				},3000);

	        }else{
	        	$scope.Msg = "Problem with Add Notes. Please Try Again!";
	        	$scope.error = true;
	        }


		}).error(function(data){
			console.log('addNote() Failure : ', data);
		});
    };

    */

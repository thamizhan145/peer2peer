var app = angular.module('p2p', ['angularUtils.directives.dirPagination', 'ngDialog', 'ngLoadingSpinner']);

app.controller('HelpCtrl', HelpCtrl);



app.factory('httpCall', ['$http', function($http){

    console.log($('meta[name=csrf-token]').attr('content'));
    return function(Url, InputData){

        var options = {
            method: 'POST',
            url: Url,
            datatype: 'json',
            transformRequest: function(obj) {
                var str = [];
                for(var p in obj)
                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                return str.join("&");
            },
            data: InputData,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content')
             }
        };

        return $http(options);
    };

}]);


app.run(function($rootScope) {

    $rootScope.Object = Object;
    
    /*
        Receive emitted message and broadcast it.
        Event names must be distinct or browser will blow up!
    */
    $rootScope.$on('Note_Changed', function(event, args) {
        console.log('On Change');
        $rootScope.$broadcast('handle_note_change', args);
    });      

    $rootScope.$on('Prospect_Changed', function(event, args) {
        console.log('On Change');
        $rootScope.$broadcast('handle_prospect_change', args);
    });  
 
    $rootScope.$on('Attendee_Changed', function(event, args) {
        console.log('On Change', args);
        $rootScope.$broadcast('handle_attendee_change', args);
    });  
 


});
app.config(['ngDialogProvider', function (ngDialogProvider) {
    ngDialogProvider.setDefaults({
        className: 'ngdialog-theme-default',
        plain: false,
        showClose: true,
        closeByDocument: false,
        closeByEscape: false,
        appendTo: false,
        preCloseCallback: function () {
            //console.log('default pre-close callback');
        }
    });
}]);


//Not Necessary to Create Service, Same can be done in COntroller also as method like add() method
app.service('filteredListService', function () {
    this.searched = function (valLists,toSearch) {
        return _.filter(valLists, 
        function (i) {
            /* Search Text in all 3 fields */
            return searchUtil(i, toSearch);
        });        
    };
    
    this.paged = function (valLists,pageSize)
    {
        retVal = [];
        for (var i = 0; i < valLists.length; i++) {
            if (i % pageSize === 0) {
                retVal[Math.floor(i / pageSize)] = [valLists[i]];
            } else {
                retVal[Math.floor(i / pageSize)].push(valLists[i]);
            }
        }
        return retVal;
    };
 
});



function searchUtil(item, toSearch) {

    var en1 = item['Events'][0]['Name'];
    var en2 = (typeof item['Events'][1] != 'undefined')?item['Events'][1]['Name']:'undefined';
    var en3 = (typeof item['Events'][2] != 'undefined')?item['Events'][2]['Name']:'undefined';

    /* Search Text in all 3 fields */
    return (
        (typeof item.FirstName != 'undefined' && item.FirstName.toLowerCase().indexOf(toSearch.toLowerCase())) > -1 ||
        (typeof item.LastName != 'undefined' && item.LastName.toLowerCase().indexOf(toSearch.toLowerCase())) > -1 || 
        (typeof en1 != 'undefined' && en1.toLowerCase().indexOf(toSearch.toLowerCase()) > -1) ||
        (typeof en2 != 'undefined' && en2.toLowerCase().indexOf(toSearch.toLowerCase()) > -1) ||
        (typeof en3 != 'undefined' && en3.toLowerCase().indexOf(toSearch.toLowerCase()) > -1)
    ) ? true : false;
}
var emailVerify = angular.module('emailVerify',['ngRoute']);

//Routing
emailVerify.config(function ($routeProvider) {
    $routeProvider
        .when('/',
            {
                controller: 'appController',
                templateUrl: 'partials/home.html'
            })
        .otherwise({ redirectTo: '/' });
});

emailVerify.service('sharedValues', function () {

    //User details received from phone
    var userDetails = [{
                            firstName   : 'firstName',  
                            surName     : 'LastName',
                            contactEmail : 'sastha@solutionmatrix.com.sg'
                        }];
    return {
            getUserDetails: function(){
                return userDetails;
            }
        };
});
//Handle all HTTP calls to server
emailVerify.factory('appSession', function($http){
    return {
       	sendVerificationEmail: function(userDetail) {
        	return $http.post('server/Service.php',{
        		type		: 'sendVerificationEmail',
        		userDetail 	: userDetail
        	});
        }
    }
});
//controller
emailVerify.controller('appController', function($scope, appSession, sharedValues){

	
    $scope.displaySuccess= function(data, status){
        console.log(data);
    };
    $scope.displayError = function(data, status){
        console.log(data);
    };
  	$scope.sendVerificationEmail = function(){
        appSession.sendVerificationEmail(sharedValues.getUserDetails()).success($scope.displaySuccess).error($scope.displayError);  
    };
    //Initializer
	init();
	function init(){
	
	};
	
});
/**
 * Created by mithundas on 1/3/16.
 */
appModule.controller('registrationController',["$scope","$rootScope","$log","toaster","$location", "$anchorScroll",
    function($scope,$rootScope,$log,toaster,$location, $anchorScroll){
    $log.debug('registrationController loaded');

    $location.hash('body');
    $anchorScroll();

    $scope.newUser ={
        singleHour:0,
        mpristonHour:0,
        mjetHour:0,
        instrumentHour:0,
        otherHour:0
    }
    $scope.createUser = function(){

       // $('#login-menu').dropdown('toggle');
        toaster.pop('success','','Your account created');
        $rootScope.loggedIn = true;
        $rootScope.bootstrappedUser = {firstName:"John", lastName:"Smith"};
    }

    $scope.totalHour = function(){
        return $scope.newUser.singleHour
            +$scope.newUser.mpristonHour
            +$scope.newUser.mjetHour
            +$scope.newUser.instrumentHour
            +$scope.newUser.otherHour;
    }

}]);
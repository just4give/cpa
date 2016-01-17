/**
 * Created by mithundas on 1/3/16.
 */
appModule.controller('registrationController',["$scope","$rootScope","$log","toaster","$location", "$anchorScroll","AuthService",
    function($scope,$rootScope,$log,toaster,$location, $anchorScroll,AuthService){
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
    $scope.signup = function(){

       // $('#login-menu').dropdown('toggle');
        //toaster.pop('success','','Your account created');

        $scope.newUser.username = $scope.newUser.email;
        AuthService.signup($scope.newUser)
            .then(function(data){
                $log.debug(data);
                AuthService.toast(data);
                if (data.status == "success") {
                    $location.path('/');
                    $rootScope.loggedIn = true;
                    //$rootScope.bootstrappedUser = {firstName:"John", lastName:"Smith"};
                }
            },function(err){

            });



    }

    $scope.totalHour = function(){
        return $scope.newUser.singleHour
            +$scope.newUser.mpristonHour
            +$scope.newUser.mjetHour
            +$scope.newUser.instrumentHour
            +$scope.newUser.otherHour;
    }

}]);
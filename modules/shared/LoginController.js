/**
 * Created by mithundas on 1/3/16.
 */
appModule.controller('loginController',["$scope","$rootScope","$state","$log","toaster", "AuthService",
    function($scope,$rootScope,$state,$log,toaster,AuthService){
    $log.debug('loginController loaded');

    $scope.loginuser ={};

    $scope.login = function(){

       // $('#login-menu').dropdown('toggle');
       /* toaster.pop('success','','You are logged in');
        $rootScope.loggedIn = true;
        $rootScope.bootstrappedUser = {firstName:"John", lastName:"Smith"};*/
        AuthService.login($scope.loginuser)
            .then(function(data){
                $log.debug(data);
                AuthService.toast(data);
                if (data.status == "success") {

                    $rootScope.loggedIn = true;
                    $rootScope.bootstrappedUser = {firstName:data.firstName, lastName:data.lastName,email:data.email,verified: data.verified};
                }
            },function(err){

            });


    }

    $scope.logout = function(){

        $rootScope.loggedIn = false;
        $rootScope.bootstrappedUser = undefined;

        AuthService.logout($scope.loginuser)
            .then(function(data){
                $log.debug(data);
                AuthService.toast(data);


                    $rootScope.loggedIn = false;
                    $rootScope.bootstrappedUser = undefined;
                    $state.go('/');

            },function(err){

            });
    }
}]);
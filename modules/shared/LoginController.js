/**
 * Created by mithundas on 1/3/16.
 */
appModule.controller('loginController',["$scope","$rootScope","$log","toaster", function($scope,$rootScope,$log,toaster){
    $log.debug('authController loaded');
    $scope.login = function(){

       // $('#login-menu').dropdown('toggle');
        toaster.pop('success','','You are logged in');
        $rootScope.loggedIn = true;
        $rootScope.bootstrappedUser = {firstName:"John", lastName:"Smith"};
    }

    $scope.logout = function(){
        $log.debug('logging out');
        toaster.pop('success','','You are logged out');
        $rootScope.loggedIn = false;
        $rootScope.bootstrappedUser = undefined;
    }
}]);
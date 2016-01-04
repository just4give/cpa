/**
 * Created by mithundas on 1/3/16.
 */
appModule.controller('registrationController',["$scope","$rootScope","$log","toaster", function($scope,$rootScope,$log,toaster){
    $log.debug('registrationController loaded');

    $scope.createUser = function(){

       // $('#login-menu').dropdown('toggle');
        toaster.pop('success','','Your account created');
        $rootScope.loggedIn = true;
        $rootScope.bootstrappedUser = {firstName:"John", lastName:"Smith"};
    }


}]);
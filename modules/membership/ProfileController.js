/**
 * Created by mithundas on 1/3/16.
 */
appModule.controller('profileController',["$scope","$rootScope","$state","$log","toaster", "AuthService",
    function($scope,$rootScope,$state,$log,toaster,AuthService){
    $log.debug('profileController loaded');



    $scope.resend = function(){

        AuthService.resend()
            .then(function(data){
                $log.debug(data);
                AuthService.toast(data);

            },function(err){

            });
    }
}]);
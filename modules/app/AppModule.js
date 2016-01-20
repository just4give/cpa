/**
 * Created by mithundas on 12/3/15.
 */
var appModule = angular.module("cpa",['ui.router','ui.bootstrap','ngAnimate', 'ngTouch','angular-confirm',
    'LocalStorageModule','toaster']);

appModule.config(function (localStorageServiceProvider) {
    localStorageServiceProvider
        .setPrefix('cpa')
        .setStorageType('localStorage') //sessionStorage
        .setNotify(true, true)

});


appModule.run(["$log","$rootScope", "$state", "AuthService",function ($log,$rootScope, $state, AuthService) {

    $rootScope.$on("$stateChangeStart", function (event, next, current) {
        $log.debug("***route changing..." );


        AuthService.loggedIn().then(function (data) {
            if (data.id) {
                $rootScope.loggedIn = true;
                $rootScope.bootstrappedUser ={firstName:data.firstName, lastName:data.lastName,email:data.email,verified: data.verified,subscription: data.subscription};
                if(data.subscription===1){
                        $rootScope.isSubscribed = true;
                }
            }
        });
    });

    $rootScope.$on('$stateChangeError', function(event, toState, toParams, fromState, fromParams, rejection) {


        if(rejection === 'not authorized') {
            $state.go('/');
        }
    })
}]);

appModule.directive('passwordMatch', ["$log",function ($log) {


    return {
        restrict: 'A',
        scope:true,
        require: 'ngModel',
        link: function (scope, elem , attrs,control) {

            var checker = function () {

                //get the value of the first password
                var e1 = scope.$eval(attrs.ngModel);

                //get the value of the other password
                var e2 = scope.$eval(attrs.passwordMatch);
                if(e2!=null)
                    return e1 == e2;
            };
            scope.$watch(checker, function (n) {

                //set the form control to valid if both
                //passwords are the same, else invalid
                $log.debug('is password matching '+ n);
                if(n != undefined){
                    control.$setValidity("passwordNoMatch", n);
                }

            });
        }
    };
}]);
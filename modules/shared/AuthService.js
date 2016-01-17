/**
 * Created by Mithun.Das on 12/8/2015.
 */
appModule.factory('AuthService', ["$rootScope","$http","$q", "$log","toaster",function($rootScope, $http, $q,$log,toaster){

    $log.debug('loading auth service');
    var serviceBase = 'api/v1/';

    return{
        login : function(user){

            var deferred = $q.defer();

                $http.post(serviceBase+"login", user)
                    .success(function (data){

                        deferred.resolve(data);
                    })
                    .error(function(err){
                        deferred.reject(err);
                    });




            return deferred.promise;
        },
        loggedIn : function(user){

            var deferred = $q.defer();

            $http.get(serviceBase + "session")
                .success(function (data){

                    deferred.resolve(data);
                })
                .error(function(err){
                    deferred.reject('not authorized');

                });




            return deferred.promise;
        },

        signup : function(user){

            var deferred = $q.defer();

            $http.post(serviceBase + "signUp", user)
                .success(function (data){

                    deferred.resolve(data);
                })
                .error(function(err){
                    deferred.reject(err);
                });




            return deferred.promise;
        },

        logout : function(){

            var deferred = $q.defer();

            $http.post(serviceBase + "logout", {})
                .success(function (data){

                    deferred.resolve(data);
                })
                .error(function(err){
                    deferred.reject(err);
                });




            return deferred.promise;
        },
        toast : function (data) {
        toaster.pop(data.status, "", data.message, 10000, 'trustedHtml');
        },

        isAuthorized : function(){


            if($rootScope.loggedIn){
                return true;
            }else{

                return $q.reject('not authorized');
            }
        }

    }

}]);

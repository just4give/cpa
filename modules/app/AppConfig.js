appModule.config(["$stateProvider","$urlRouterProvider",
    function($stateProvider, $urlRouterProvider) {

        var routeRoleChecks = {
            admin: {auth: function(AuthService) {
                return AuthService.isAuthorized();
            }}
        }

	$urlRouterProvider.otherwise('/');
    
    $stateProvider
      .state('/', {
         url: '/',
         templateUrl: 'modules/app/tmpl/home.html',
         controller: "HomeController"
     })
     .state('join', {
        url: '/join',
        templateUrl: 'modules/membership/tmpl/registration.html',
        controller: "registrationController"
    }).state('profile', {
        url: '/profile',
        templateUrl: 'modules/membership/tmpl/profile.html',
        resolve: routeRoleChecks.admin
    });



        
}]);



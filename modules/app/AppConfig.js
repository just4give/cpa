appModule.config(["$stateProvider","$urlRouterProvider",
    function($stateProvider, $urlRouterProvider) {

        var routeRoleChecks = {
            admin: {auth: function(AuthService) {
                return AuthService.isAuthorized();
            }},
            subscribed: {subscribed: function(AuthService) {
                return AuthService.isSubscribed();
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
        controller:'profileController',
        resolve: routeRoleChecks.admin
    }).state('bluestar', {
        url: '/member.bluestar',
        templateUrl: 'modules/membership/tmpl/bluestar.html',
        resolve: routeRoleChecks.subscribed
    });



        
}]);



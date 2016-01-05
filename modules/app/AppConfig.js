appModule.config(["$stateProvider","$urlRouterProvider",function($stateProvider, $urlRouterProvider) {
    
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
    });



        
}]);

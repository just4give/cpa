appModule.config(["$stateProvider","$urlRouterProvider",function($stateProvider, $urlRouterProvider) {
    
	$urlRouterProvider.otherwise('/');
    
    $stateProvider
      .state('/', {
         url: '/',
         templateUrl: 'modules/app/tmpl/home.html',
         controller: "HomeController"
     })
     ;


        
}]);

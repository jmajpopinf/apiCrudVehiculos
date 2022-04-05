var app =  angular.module('main-App',['ngRoute']);
app.config(function($routeProvider) {
        $routeProvider
			.when('/home', {
	            templateUrl: 'templates/posts.html',
	            controller: 'PostController'
	        })
			.when('/login', {
	            templateUrl: 'templates/login.html',
	            controller: 'loginController'
	        })
			.when('/register', {
	            templateUrl: 'templates/register.html',
	            controller: 'registerController'
	        });
});


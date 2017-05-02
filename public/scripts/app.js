(function() {

    'use strict';

    angular
        .module('app', ['ui.router', 'satellizer','ngMessages','ui.bootstrap','ngMaterial','lfNgMdFileInput'])
        .config(function($stateProvider, $urlRouterProvider, $authProvider, $httpProvider) {

            // Satellizer configuration that specifies which API
            // route the JWT should be retrieved from
            $httpProvider.interceptors.push('authInterceptor');
            $authProvider.loginUrl = '/api/authenticate';

            // Redirect to the auth state if any other states
            // are requested other than users
            $urlRouterProvider.otherwise('/login');
            
            $stateProvider
                .state('login', {
                    url: '/login',
                    templateUrl: 'scripts/app/views/login.html',
                    controller: 'loginController',
                    authenticate: false
                })
                .state('home', {
                    url: '/',
                    templateUrl: 'scripts/app/views/app-main.html',
                    controller: 'homeController',
                    authenticate: true
                })
                .state('register',{
                    url: '/register',
                    templateUrl: "scripts/app/views/register.html",
                    controller: "registerController",
                    authenticate: false
                })
        })
        .run(['$rootScope','$state', run]);
        function run($rootScope, $state) {
            $rootScope.$on("$stateChangeStart", function(event, toState, toParams, fromState, fromParams){
                if (toState.authenticate && !localStorage.getItem('token')) {
                    $state.transitionTo("login");
                    event.preventDefault();
                } else if (toState.name === "login" && !!localStorage.getItem('token')){
                    $state.transitionTo("home");
                    event.preventDefault();
                }
            });
        }
})();
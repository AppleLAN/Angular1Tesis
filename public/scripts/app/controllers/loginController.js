(function () {
'use strict';
angular
.module('app')
.controller('loginController', function ($scope, $location, authService, $state) {
  var login = {};
  login.isActive = function (viewLocation) {
    return viewLocation === $location.path();
  };
  login.goTo = function() {
    $location.url('register');
  };
  login.logIn = function () {
   authService.logIn(login.userInfo).then(function(data) {
      // If login is successful, redirect to the users state
      localStorage.setItem('token',data.data.token);
      $state.go('home', {});
    });
  };
  $scope.login = login;
});
})();

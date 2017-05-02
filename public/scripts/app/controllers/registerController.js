(function () {
'use strict';
angular
.module('app')
.controller('registerController', function ($scope, $location, authService, $state) {
  var register = {};
  register.userInfo = {};
  register.userInfo.sales = 0;
  register.userInfo.stock = 0;
  register.userInfo.clients = 0;
  register.userInfo.providers = 0;
  register.isActive = function (viewLocation) {
    return viewLocation === $location.path();
  };

  register.goTo = function() {
    $location.url('');
  };
  register.cancel = function() {
    $state.go('login', {});
  };

  register.register = function () {
    authService.register(register.userInfo).then(function(users) {
      $state.go('home', {});
    }),(function(error) {
      $state.go('login', {});
    });
  };

  $scope.register = register;
});
})();

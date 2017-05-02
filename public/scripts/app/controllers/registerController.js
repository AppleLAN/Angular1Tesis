(function () {
'use strict';
angular
.module('app')
.controller('registerController', function ($scope, $location, authService, $state) {
  var register = {};

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
      $state.go('main', {});
    }),(function(error) {
      $state.go('login', {});
    });
  };

  $scope.register = register;
});
})();

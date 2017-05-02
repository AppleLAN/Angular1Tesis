(function () {
'use strict';
angular
.module('app')
.controller('homeController', function ($scope, $location, $auth, $state) {
  var personal = {};
  personal.isActive = function (viewLocation) {
    return viewLocation === $location.path();
  };
  personal.return = function() {
    $state.go('main', {});
  };
  $scope.personal = personal;
});
})();

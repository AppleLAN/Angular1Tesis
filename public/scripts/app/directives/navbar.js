(function () {
'use strict';
angular
.module('app')
.directive('navBar', function () {
  return {
    templateUrl: 'scripts/app/views/navbar.html',
    controller: function ($scope, $location) {
      var navbar = this;
      navbar.logOut = function () {
        localStorage.clear();
        $location.url('login');
      };
      navbar.isActive = function(url) {
        return $location.$$url === url;
      }
      $scope.navbar = navbar;
    },
  };
});
})();

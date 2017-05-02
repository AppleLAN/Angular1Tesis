(function () {
'use strict';
angular
.module('app')
.directive('sideBar', function () {
  return {
    templateUrl: 'scripts/app/views/sidebar.html',
    controller: function ($rootScope, $scope) {
      var sidebar = this;
      $scope.sidebar = sidebar;
    },
  };
});
})();

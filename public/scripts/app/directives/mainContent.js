(function () {
'use strict';
angular
.module('app')
.directive('mainContent', function () {
  return {
    templateUrl: 'scripts/app/views/main-content.html',
    controller: function ($scope, $location) {
      var content = this;
      $scope.content = content;
    },
  };
});
})();

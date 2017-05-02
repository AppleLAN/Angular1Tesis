(function () {
'use strict';
angular
.module('app')
.directive('mainContent', function () {
  return {
    templateUrl: 'scripts/app/views/main-content.html',
    controller: function ($scope, $location, userService) {
      var content = this;
      userService.getUserApps().then(function(response) {
        content.apps = response.data.apps;
      });
      $scope.content = content;
    },
  };
});
})();

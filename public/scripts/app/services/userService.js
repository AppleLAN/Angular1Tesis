angular
.module('app')
.factory('userService', [
  '$log',
  '$http',
  '$auth',
  userService,
]);

function userService($log, $http, $auth) {

  function getUserApps() {
    return $http({ method: "GET", url: 'api/getUserApps', cache: false });
  }

  const service = {
    getUserApps,
  };

  return service;
}

angular
.module('app')
.factory('authService', [
  '$log',
  '$http',
  '$auth',
  authService,
]);

function authService($log, $http, $auth) {
  function logIn(userInfo) {
    return $auth.login(userInfo);
  }

  function register(userInfo) {
    return $http({ method: "POST", url: 'api/signup', data: userInfo, cache: false });
  }

  const service = {
    logIn,
    register,
  };

  return service;
}

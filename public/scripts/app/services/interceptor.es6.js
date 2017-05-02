(function () {
'use strict';

angular
    .module('app')
    .factory('authInterceptor', [
        '$q',
        authInterceptor
    ]);


function authInterceptor ($q) {
  return {
    request: function (config) {
      config.headers = config.headers || {};
      if (localStorage.getItem('token')) {
        config.headers['X-Auth-Token'] = localStorage.getItem('token');
      }
      return config;
    },
    response: function (response) {
      if (response.status === 401 && response.status === 400) {
        localStorage.clear();
      }
      return response || $q.when(response);
    }
  };
}

})();
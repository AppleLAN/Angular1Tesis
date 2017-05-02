(function () {
'use strict';

angular
    .module('app')
    .factory('apiService', [
        '$q',
        '$log',
        apiService,
    ]);

const BAD_REQUEST = 400;
const NOT_FOUND   = 404;
const RECOVERABLE_ERRORS = [BAD_REQUEST, NOT_FOUND];

function apiService($q, $log) {

  return {
      extract: extract,
      logError: logError,
      resolveBadRequest: resolveBadRequest,
    };

  function extract(response) {
    var { config, data, headers, status } = response;

    if (status === 200) {
      $log.info('HTTP' + status, data);
      return data;
    }

    $log.error('HTTP' + status, data);

    return $q.reject(data);
  }

  function logError(rejection) {
    var { data, status } = rejection;
    $log.error('HTTP' + status, data);

    return $q.reject(rejection);
  }

  function resolveBadRequest(resolver) {
    return function (rejection) {
        var { data, status } = rejection;

        if (RECOVERABLE_ERRORS.indexOf(status) != -1) {
          return $q.resolve(resolver(data));
        }

        return $q.reject(rejection);
      };
  }

}
})();

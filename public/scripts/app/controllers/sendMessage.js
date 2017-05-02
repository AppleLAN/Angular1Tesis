(function () {
'use strict';
angular
.module('app')
.controller('sendMessageController', function ($scope, $location) {
  var sendMessage = {};
  emailService.getUsers().then(function(data){
    sendMessage.users = data.data.data;
  });
  
  sendMessage.isActive = function (viewLocation) {
    return viewLocation === $location.path();
  };
  sendMessage.goTo = function() {
    $location.url('');
  };
  sendMessage.send = function () {
    emailService.sendEmail(sendMessage.email,sendMessage.attachment);
    $location.url('');
  };
  $scope.sendMessage = sendMessage;
});
})();

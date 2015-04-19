(function () {
    'use strict';

    angular
        .module('app', [])
        .controller('MessagesCtrl', MessagesCtrl);

    MessagesCtrl.$inject = ['$http', '$scope'];

    function MessagesCtrl($http, $scope) {
        /* jshint validthis: true */
        var vm = this;
        var socket = io.connect("http://localhost:8346");

        vm.activate = activate;
        vm.submitForm = submitForm;

        activate();

        socket.on('message.created', function (notification) {
            $scope.$apply(function () {
                vm.messages.push(notification);
            });
        });

        socket.on('message.updated', function (notification) {
            console.log('message.updated', notification);
            $scope.$apply(function () {
                var index = vm.messages.findIndex(function (m) {
                    return m.id === notification.id;
                });
                if (index) {
                    vm.messages[index] = notification;
                }
            });
        });

        socket.on('message.deleted', function (notification) {
            console.log('message.deleted', notification);
            $scope.$apply(function () {
                var index = vm.messages.findIndex(function (m) {
                    return m.id === notification.id;
                });
                if (index) {
                    vm.messages.splice(index, 1)
                }
            })
        });

        ////////////////

        function activate() {
            vm.form = {
                author  : undefined,
                content : undefined
            };

            loadData();
        }

        function loadData() {
            $http.get('/messages')
                .success(function (data) {
                    vm.messages = data;
                });
        }

        function submitForm(form) {
            $http.post('/messages', form)
                .success(function (data) {
                    vm.form.content = undefined;
                });
        }
    }
})();
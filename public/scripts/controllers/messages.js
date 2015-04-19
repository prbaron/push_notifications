(function () {
    'use strict';

    angular
        .module('app', [])
        .controller('MessagesCtrl', MessagesCtrl);

    MessagesCtrl.$inject = ['$http', '$scope'];

    function MessagesCtrl($http, $scope) {
        /* jshint validthis: true */
        var vm = this;
        var socket = io.connect("https://arato-push.herokuapp.com");

        vm.activate = activate;
        vm.submitForm = submitForm;

        activate();

        socket.on('alert.created', function (notification) {
            console.log('alert.created', notification);
            $scope.$apply(function () {
                vm.messages.push(notification);
            });
        });

        socket.on('alert.updated', function (notification) {
            console.log('alert.updated', notification);
            $scope.$apply(function () {
                var index = vm.messages.findIndex(function (m) {
                    return m.id === notification.id;
                });
                if (index) {
                    vm.messages[index] = notification;
                }
            });
        });

        socket.on('alert.deleted', function (notification) {
            console.log('alert.deleted', notification);
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
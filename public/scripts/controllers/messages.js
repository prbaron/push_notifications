(function () {
    'use strict';

    angular
        .module('app', [])
        .controller('MessagesCtrl', MessagesCtrl);

    MessagesCtrl.$inject = ['$http', '$interval'];

    function MessagesCtrl($http, $interval) {
        /* jshint validthis: true */
        var vm = this;

        vm.activate = activate;
        vm.submitForm = submitForm;

        activate();

        ////////////////

        function activate() {
            vm.form = {
                author  : undefined,
                content : undefined
            };

            loadData();

            $interval(loadData, 2000);
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
                    loadData();
                });
        }
    }
})();
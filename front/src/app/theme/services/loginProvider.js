/**
 * Created by majdi on 28/09/2016.
 */
(function () {
    'use strict';

    angular.module('BlurAdmin.theme')
    .provider("checkLogin", function checkLoginProvider(){

        /**
         * Helper auth functions
         */
        var skipIfLoggedIn = function($q, $auth) {
            var deferred = $q.defer();
            if ($auth.isAuthenticated()) {
                deferred.reject();
            } else {
                deferred.resolve();
            }
            return deferred.promise;
        };

        var loginRequired = function($q, $location, $auth) {
            var deferred = $q.defer();
            if ($auth.isAuthenticated()) {
                deferred.resolve();
            } else {
                $location.path('/login');
            }
            return deferred.promise;
        };

        this.checker = {
            skipIfLoggedIn: skipIfLoggedIn,
            loginRequired: loginRequired
        };

        this.$get = function() {
            return {
                skipIfLoggedIn: skipIfLoggedIn,
                loginRequired: loginRequired
            };
        };
    });
})();
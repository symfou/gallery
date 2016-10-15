/**
 * Created by majdi on 28/09/2016.
 */
angular.module('BlurAdmin.pages.login')
    .provider("checkLogin", function checkLoginProvider(){
        /**
         * Helper auth functions
         */
        skipIfLoggedIn = function($q, $auth) {
            var deferred = $q.defer();
            if ($auth.isAuthenticated()) {
                deferred.reject();
            } else {
                deferred.resolve();
            }
            return deferred.promise;
        };

        loginRequired = function($q, $location, $auth) {
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
            loginRequired: loginRequired,
            testi: '/loginnn'
        };

        this.$get = function() {
            return {
                skipIfLoggedIn: skipIfLoggedIn,
                loginRequired: loginRequired,
                testi: '/loginnn'
            };
        };
    });

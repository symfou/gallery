/**
 * Created by majdi on 28/09/2016.
 */
(function () {
    'use strict';

    angular.module('BlurAdmin.pages.login', [])
        .config(routeConfig);

    /** @ngInject */
    function routeConfig($stateProvider, $authProvider, checkLoginProvider) {
        
        $stateProvider
            .state('login', {
                url: '/login',
                templateUrl: 'app/pages/login/login.html',
                title: 'Login',
                sidebarMeta: {
                    order: 0,
                },
                controller: 'LoginPageCtrl',
                resolve: {
                    skipIfLoggedIn: checkLoginProvider.checker.skipIfLoggedIn
                }
            })
            .state('logout', {
                url: '/logout',
                template: null,
                controller: 'LogoutCtrl'
            })
        ;
    }

})();


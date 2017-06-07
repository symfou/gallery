/**
 * Created by majdi on 28/09/2016.
 */
(function () {
    'use strict';

    angular.module('BlurAdmin.pages.products', [])
        .config(routeConfig);

    /** @ngInject */
    function routeConfig($stateProvider, $authProvider, checkLoginProvider) {


        $stateProvider
            .state('products', {
                url: '/products',
                template : '<ui-view></ui-view>',
                abstract: true,
                title: 'Products',
                sidebarMeta: {
                    icon: 'ion-android-laptop',
                    order: 1,
                },
            })

            .state('products.list', {
                url: '/list',
                templateUrl: 'app/pages/products/templates/index.html',
                title: 'List Products',
                sidebarMeta: {
                    order: 0
                },
                controller: 'ProductsPageCtrl',
                controllerAs: "ProductsPageCtrl",
                /*resolve: {
                    loginRequired: checkLoginProvider.checker.loginRequired
                }*/
            })

            .state('products.detail', {
                views: {
                    '@': {
                        templateUrl: 'app/pages/products/templates/detail.html',
                        controller: 'ProductDetailCtrl',
                        controllerAs: 'ProductDetailCtrl'
                    }
                },
                url: '/detail/:id',
                parent: 'products',
                resolve: {
                    loginRequired: checkLoginProvider.checker.loginRequired
                }
            })

            .state('products.new', {
                views: {
                    '@': {
                        templateUrl: 'app/pages/products/templates/new.html',
                        controller: 'ProductCreateCtrl',
                        controllerAs: 'ProductCreateCtrl'
                    }
                },
                url: '/new',
                parent: 'products',
                title: 'New Products',
                sidebarMeta: {
                    order: 1
                },
                resolve: {
                    loginRequired: checkLoginProvider.checker.loginRequired
                }
            })


            .state('products.edit', {
                views: {
                    '@': {
                        templateUrl: 'app/pages/products/templates/edit.html',
                        controller: 'ProductUpdatePutCtrl',
                        controllerAs: 'ProductUpdatePutCtrl'
                    }
                },
                url: '/edit/:id',
                parent: 'products',
                resolve: {
                    loginRequired: checkLoginProvider.checker.loginRequired
                }
            })
        ;
    }

})();


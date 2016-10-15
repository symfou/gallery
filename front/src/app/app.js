'use strict';

angular.module('BlurAdmin', [
      'ngProgress',
  'satellizer',
  'ngResource',
  'ngMessages',
  'ngAnimate',
  'ui.bootstrap',
  'ui.sortable',
  'ui.router',
  'ngTouch',
  'toastr',
  'smart-table',
  "xeditable",
  'ui.slimscroll',
  'ngJsTree',
  'angular-progress-button-styles',

  'BlurAdmin.theme',
  'BlurAdmin.pages'
])
    .constant('apiPrefix', '/api/app_dev.php')
    .constant("OAUTH2", {
      "CLIENT_ID": "11_4lit6kyrv86cwgw8cc0c8ogwgws0oookk0o40kccww840s00wc",
      "CLIENT_SECRET": "30wn0vfonj0g0wgckw4okggk88w8888o0c4o8kgksw08kgww4s",
      "GRANT_TYPE": "password"
    })

.config(function($stateProvider, $urlRouterProvider, $authProvider) {

  

  /**
   * App routes
   */
  /*$stateProvider
      .state('home', {
        url: '/',
        controller: 'HomeCtrl',
        templateUrl: 'partials/home.html'
      })
      .state('login', {
        url: '/login',
        templateUrl: 'partials/login.html',
        controller: 'LoginCtrl',
        resolve: {
          skipIfLoggedIn: skipIfLoggedIn
        }
      })
      .state('signup', {
        url: '/signup',
        templateUrl: 'partials/signup.html',
        controller: 'SignupCtrl',
        resolve: {
          skipIfLoggedIn: skipIfLoggedIn
        }
      })
      .state('logout', {
        url: '/logout',
        template: null,
        controller: 'LogoutCtrl'
      })
      .state('profile', {
        url: '/profile',
        templateUrl: 'partials/profile.html',
        controller: 'ProfileCtrl',
        resolve: {
          loginRequired: loginRequired
        }
      })
      .state('products', {
        url: '/products',
        templateUrl: 'templates/products/index.html',
        controller: 'ProductsCtrl',
        controllerAs: 'ProductsCtrl',
        resolve: {
          loginRequired: loginRequired
        }
      })

      .state('products.detail', {
        views: {
          '@': {
            templateUrl: 'templates/products/detail.html',
            controller: 'ProductDetailCtrl',
            controllerAs: 'ProductDetailCtrl'
          }
        },
        url: '/detail/:id',
        parent: 'products',
        resolve: {
          loginRequired: loginRequired
        }
      })


      .state('products.new', {
        views: {
          '@': {
            templateUrl: 'templates/products/new.html',
            controller: 'ProductCreateCtrl',
            controllerAs: 'ProductCreateCtrl'
          }
        },
        url: '/new',
        parent: 'products',
        resolve: {
          loginRequired: loginRequired
        }
      })

  ;
  $urlRouterProvider.otherwise('/');
*/
  /**
   *  Satellizer config
   */

  
});
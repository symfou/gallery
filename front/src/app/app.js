'use strict';

angular.module('BlurAdmin', [
    'ngImgCrop',
        'ngFileUpload',
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
    .constant('API_PREFIX', '/api/app_dev.php')
    .constant('API_IMAGE_PREFIX', '/api/')
    .constant('DEFAULT_PRODUCT_IMAGE', 'bundles/wbiapiproduct/images/thumbnail-default.jpg')
    .constant("OAUTH2", {
        "CLIENT_ID": "8_194gg64aqu3o4o8c44s888o4sk0scko0w48s80gcoog4gg4gow",
        "AUTH_URL": "http://majdi.com:8085/auth/app_dev.php/admin/oauth/v2/auth/",
        "AUTH_SIGNOUT_URL": "http://majdi.com:8085/auth/app_dev.php/logout",
        "AUTH_SIGNIN_URL": "http://majdi.com:8085/auth/app_dev.php/login",
        "AUTH_BASE_URL": "http://majdi.com:8085/auth/app_dev.php/",
        "RESPENSE_TYPE": "token"
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
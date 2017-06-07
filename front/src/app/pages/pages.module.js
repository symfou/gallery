/**
 * @author v.lugovsky
 * created on 16.12.2015
 */
(function () {
  'use strict';

  angular.module('BlurAdmin.pages', [
    'ui.router',

    'BlurAdmin.pages.dashboard',
    'BlurAdmin.pages.ui',
    'BlurAdmin.pages.components',
    'BlurAdmin.pages.form',
    'BlurAdmin.pages.tables',
    'BlurAdmin.pages.charts',
    'BlurAdmin.pages.maps',
    'BlurAdmin.pages.profile',
    'BlurAdmin.pages.login',
    'BlurAdmin.pages.products'
  ])
      .config(routeConfig);

  /** @ngInject */
  function routeConfig($urlRouterProvider, baSidebarServiceProvider, $authProvider) {




    // $authProvider.baseUrl = '/';
    // $authProvider.loginUrl = '/api/oauth/v2/token';
    // $authProvider.signupUrl = '/api/auth/signup';
    // $authProvider.unlinkUrl = '/api/auth/unlink/';
    $authProvider.tokenName = 'access_token';
    $authProvider.tokenPrefix = 'wbi';
    $authProvider.storageType = 'sessionStorage';


    // Generic OAuth 2.0
    $authProvider.oauth2({
      name: 'wbi_store_admin',
      url: 'http://majdi.com:8085/auth/app_dev.php/oauth/v2/auth',
      clientId: '14_4lit6kyrv86cwgw8cc0c8ogwgws0oookk0o40kccww840s00wc',
      redirectUri: 'http://majdi.com:3000',
      authorizationEndpoint: 'http://majdi.com:8085/auth/app_dev.php/admin/oauth/v2/auth',
      defaultUrlParams: ['response_type', 'client_id', 'redirect_uri'],
      responseType: 'token',
      // requiredUrlParams: null,
      // optionalUrlParams: null,
      // scope: null,
      // scopePrefix: null,
      // scopeDelimiter: null,
      // state: null,
      // oauthType: '2.0',
      // popupOptions: null,
      responseParams: {
        code: 'code',
        clientId: 'clientId',
        redirectUri: 'redirectUri'
      }
    });
    


    $urlRouterProvider.otherwise('/dashboard');

    baSidebarServiceProvider.addStaticItem({
      title: 'Pages',
      icon: 'ion-document',
      subMenu: [{
        title: 'Sign In',
        fixedHref: 'auth.html',
        blank: true
      }, {
        title: 'Sign Up',
        fixedHref: 'reg.html',
        blank: true
      }, {
        title: 'User Profile',
        stateRef: 'profile'
      }, {
        title: '404 Page',
        fixedHref: '404.html',
        blank: true
      }]
    });
    baSidebarServiceProvider.addStaticItem({
      title: 'Menu Level 1',
      icon: 'ion-ios-more',
      subMenu: [{
        title: 'Menu Level 1.1',
        disabled: true
      }, {
        title: 'Menu Level 1.2',
        subMenu: [{
          title: 'Menu Level 1.2.1',
          disabled: true
        }]
      }]
    });
  }

})();

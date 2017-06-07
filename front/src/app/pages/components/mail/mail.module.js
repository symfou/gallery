/**
 * @author v.lugovsky
 * created on 16.12.2015
 */
(function () {
  'use strict';

  angular.module('BlurAdmin.pages.components.mail', [])
    .config(routeConfig);

  /** @ngInject */
  function routeConfig($stateProvider,$urlRouterProvider, $authProvider, checkLoginProvider) {
    $stateProvider
        .state('components.mail', {
          url: '/mail',
          abstract: true,
          templateUrl: 'app/pages/components/mail/mail.html',
          controller: "MailTabCtrl",
          controllerAs: "tabCtrl",
          title: 'Mail',
          sidebarMeta: {
            order: 0,
          },
            resolve: {
                loginRequired: checkLoginProvider.checker.loginRequired
            }
        })
        
        .state('components.mail.label', {
          url: '/:label',
          templateUrl: 'app/pages/components/mail/list/mailList.html',
          title: 'Mail',
          controller: "MailListCtrl",
          controllerAs: "listCtrl",
        resolve: {
            loginRequired: checkLoginProvider.checker.loginRequired
        }
        })
        
        .state('components.mail.detail', {
          url: '/:label/:id',
          templateUrl: 'app/pages/components/mail/detail/mailDetail.html',
          title: 'Mail',
          controller: "MailDetailCtrl",
          controllerAs: "detailCtrl",
        resolve: {
            loginRequired: checkLoginProvider.checker.loginRequired
        }
        });
    $urlRouterProvider.when('/components/mail','/components/mail/inbox');
  }

})();

/**
 * @author v.lugovksy
 * created on 16.12.2015
 */
(function () {
  'use strict';

  angular.module('BlurAdmin.pages.form')
      .directive('switch', switchDirective);

  /** @ngInject */
  function switchDirective($timeout) {
    return {
      restrict: 'EA',
      replace: true,
      require: 'ngModel',
      scope: {
        bootstrapOptions: '='
      },
      template: function(el, attrs) {

        return '<div class="switch-container ' + (attrs.color || '' + attrs.class || '') + '"><input type="'+attrs.type+'" name="'+attrs.name+'"></div>';
      },
      link: function (scope, elem, attr, ctrl) {
              var input = $(elem).find('input');
              if (scope.bootstrapOptions) {
                  $.each(scope.bootstrapOptions, function (key, val) {
                      if (val == "" || val == null) {
                          input.attr(key, "");
                      } else {
                          input.attr(key, val);
                      }
                  })
              }
              input.bootstrapSwitch({
                  onColor: attr.color
              });

              input.on('switchChange.bootstrapSwitch', function (event, state) {
                  if (ctrl.$modelValue === state){
                      // ctrl.$setViewValue(!state);
                      ctrl.$setViewValue(state);
                  }else {
                      ctrl.$setViewValue(state);
                  }
              });

              // update the color picker whenever the value on the scope changes
              ctrl.$render = function () {
                  input.bootstrapSwitch('state', ctrl.$modelValue);
              };
      }
    };
  }
})();

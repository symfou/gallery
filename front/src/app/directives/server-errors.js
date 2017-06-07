/**
 * Created by majdi on 15/10/2016.
 */
angular.module('BlurAdmin')
.directive('wbiServerInput', function(){
    return {
        restrict: 'E',
        // require: '?ngModel',
        // replace: true,
        scope: {
            form: '=',
            fieldErrorMessage: '=',
            fieldModel: '=',
            fieldName: '@',
            fieldType: '@',
            fieldLabel: '@',
            fieldPlaceholder: '@'
        },
        templateUrl: 'app/directives/server-input.html',
        link: function (scope, elem, attr, ctrl) {

            /*scope.form.$render = function(){
                scope.fieldModel = scope.form.$modelValue;
            };*/


            elem.on('change', function(){
                scope.form.$setValidity('serverError', true);
                //scope.form.$setViewValue(scope.fieldModel);
                /*scope.form.$render = function(){
                    scope.fieldModel = scope.form.$modelValue;
                };*/
            })
        }
    }
});
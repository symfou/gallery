/**
 * Created by majdi on 30/09/2016.
 */
angular.module('BlurAdmin.pages.products')
    .directive("productForm", function () {
        return {
            restrict: 'E',
            // require: '?ngModel',
            scope: true,
            /*scope: {
                product: '=',
                productEditForm: '=',
                errors: '=',
            },*/
            templateUrl: "app/pages/products/templates/directives/product-form.html",
            link: function ($scope, elem, attr, ctrl) {
                
            }
        };
    })
/**
 * Created by majdi on 30/09/2016.
 */
angular.module('BlurAdmin.pages.products')
    .directive("productForm", function () {
        return {
            restrict: 'E',
            templateUrl: "app/pages/products/templates/directives/product-form.html",
        };
    })
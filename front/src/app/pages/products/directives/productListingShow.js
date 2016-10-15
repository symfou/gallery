/**
 * Created by majdi on 29/09/2016.
 */
angular.module('BlurAdmin.pages.products')
.directive("productListingShow", function () {
    return {
        restrict: 'E',
        templateUrl: "app/pages/products/templates/directives/productListingShow.html",
        scope: {
            product: '='
        }
    };
})
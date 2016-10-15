/**
 * Created by majdi on 28/09/2016.
 */

angular.module('BlurAdmin.pages.products')



    .controller('ProductsPageCtrl', function($scope, $location, $auth, toastr, $http, Products) {
        var controller = this;
        // $scope = {};
        $scope.title = 'Product list';
        $scope.$watch('product.is_published', function (value) {
            console.log(value);
        });
        Products.all()
         .success(function(data){
            $scope.products = data;
             toastr.success("success");
        }).error(function (error) {
            toastr.error('error');
        });

    })

    .controller('ProductCtrl', function($scope, $stateParams, $auth, toastr, $http, Products) {
        $scope.$watch('product.is_published', function (newValue, oldValue, scope) {
            var product = scope.$parent.product;
            if (newValue != oldValue) {
                Products.patch({'product_type': {'is_published': newValue}}, product.id).success(function (data) {
                    toastr.success("success");
                }).error(function (error) {
                    toastr.error('error');
                    scope = oldValue;
                });
            }
        })
    })

    .controller('ProductDetailCtrl', function($scope, $http, $stateParams, toastr, Products){
        var controller = this;
        Products.find($stateParams.id)
        .success(function(data){
            controller.product = data;
            toastr.success("success");
        }).error(function (error) {
            toastr.error('error');
        });
    })



.controller("ProductCreateCtrl", function($scope, $http, toastr, Products){
    $scope.createProduct = function(product){
        Products.create({'product_type':product}).success(function(data){
            toastr.success("success");
        }).error(function (error) {
            toastr.error('error');
        });
    };
})


    .controller("ProductUpdatePutCtrl", function($scope, $http, toastr, Products, $stateParams){
        Products.find($stateParams.id)
            .success(function(data){
                //deleting fields
                delete data.created_at;
                delete data.updated_at;
                $scope.product = data;
                toastr.success("success");
            }).error(function (error) {
                toastr.error('error');
            });

        $scope.updatePutProduct = function(product){
            Products.put({'product_type':product}, $stateParams.id).success(function(data){
                toastr.success("success");
            }).error(function (error) {
                toastr.error('error');
            });
        };
    })


;

/**
 * Created by majdi on 29/09/2016.
 */
angular.module('BlurAdmin')
.factory("Products", function ProductsFactory($http) {
    return {
        all: function () {
            return $http({method: 'GET', url: '/api/v1/products'});
        },
        create: function (data) {
            return $http({method: 'POST', url: '/api/v1/products', data: data});
        },
        put: function (data, id) {
            delete data['product_type']['id'];
            return $http({method: 'PUT', url: '/api/v1/products/' + id, data: data});
        },
        patch: function (data, id) {
            return $http({method: 'PATCH', url: '/api/v1/products/' + id, data: data});
        },
        find: function (id) {
            return $http({method: 'GET', url:'/api/v1/products/'+ id});
        }
    }
});
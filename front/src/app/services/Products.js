/**
 * Created by majdi on 29/09/2016.
 */
angular.module('BlurAdmin')
.factory("Products", function ProductsFactory($http, Upload, API_PREFIX) {
    // Can be an injected constant, value, or taken from some service
    var apiUrl = API_PREFIX;

    function remove_field(field, object){
        angular.forEach(object, function(val, key){
            if (key == field){
                delete object[key];
            }else{
                if (typeof val === 'object' && val !== null){
                    remove_field(field, val)
                }
            }
        });
    }
    return {
        all: function () {
            return $http({method: 'GET', url: apiUrl+'/api/v1/products'});
        },
        create: function (data) {
            return $http({method: 'POST', url: apiUrl+'/api/v1/products', data: data});
        },
        put: function (data, id) {
            remove_field('id', data);
            remove_field('created_at', data);
            remove_field('updated_at', data);
            remove_field('image', data);
            return $http({method: 'PUT', url: apiUrl+'/api/v1/products/' + id, data: data});
        },
        patch: function (data, id) {
            return $http({method: 'PATCH', url: apiUrl+'/api/v1/products/' + id, data: data});
        },
        find: function (id) {
            return $http({method: 'GET', url: apiUrl+'/api/v1/products/'+ id});
        },
        checkLocation: function (location) {
            return $http({method: 'GET', url: apiUrl+location});
        },
        upload: function (data, id, isDefault) {
            return Upload.upload({
                url: apiUrl+'/api/v1/products/'+id+'/upload/image',
                data: {
                    file: data,
                    is_default: isDefault
                }
            });
        },
        deleteImage: function (id) {
            return $http({method: 'DELETE', url: apiUrl+'/api/v1/products/'+id+'/delete/image'});
        },
        setDefaultImage: function (data, id) {
            return $http({method: 'PATCH', url: apiUrl+'/api/v1/products/'+id+'/default/image', data: data});
        },
        getProductGallery: function (id) {
            return $http({method: 'GET', url: apiUrl+'/api/v1/products/'+id+'/gallerys'});
        }
        
    }
});
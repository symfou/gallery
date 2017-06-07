/**
 * Created by majdi on 29/09/2016.
 */
angular.module('BlurAdmin')
    .factory("User", function ProductsFactory($http, API_PREFIX) {
        
        return {
            checkUser: function () {
                return $http({method: 'GET', url: API_PREFIX + '/api/v1/checkUser'});
            }
        }
    });
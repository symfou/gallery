/**
 * Created by majdi on 27/11/2016.
 */
angular.module('BlurAdmin')
    .service('checkAuthentication', ['$q', '$location', '$window', 'oauth2', 'OAUTH2', '$injector', function ($q, $location, $window, oauth2, OAUTH2, $injector) {
        return {
            /*'request': function (config) {
                config.headers = config.headers || {};
                if ($localStorage.token) {
                    config.headers.Authorization = 'Bearer ' + $localStorage.token;
                }
                return config;
            },*/
            'responseError': function (response) {
                $auth = $injector.get('$auth');
                if (response.status === 401) {
                    if ($auth.isAuthenticated()){
                        $window.location.replace(OAUTH2.AUTH_SIGNIN_URL);
                    }else{
                        $window.location.replace(oauth2.url);
                    }
                }
                if (response.status === 403) {
                    $window.location.replace(OAUTH2.AUTH_SIGNIN_URL);
                }
                return $q.reject(response);
            }
        };
    }])

.config(['$httpProvider', function ($httpProvider) {
    $httpProvider.interceptors.push('checkAuthentication');
}]);
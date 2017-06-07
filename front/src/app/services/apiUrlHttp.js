/**
 * Created by majdi on 28/09/2016.
 */
angular.module('BlurAdmin')

    .factory('apiUrlHttpInterceptor', function () {
        // Can be an injected constant, value, or taken from some service
        var apiUrl = '/api/app_dev.php';
        var shouldPrependApiUrl = function (reqConfig) {
            if (!apiUrl) return false;
            return !(/[\s\S]*.html/.test(reqConfig.url) ||
            (reqConfig.url && reqConfig.url.indexOf(apiUrl) === 0));
        };
        return {
            request: function (reqConfig) {
                // Filter out requests for .html templates, etc
                if (apiUrl && shouldPrependApiUrl(reqConfig)) {
                    reqConfig.url = apiUrl + reqConfig.url;
                }
                return reqConfig;
            }
        };
    })

    .config(['$httpProvider', function ($httpProvider) {
        // $httpProvider.interceptors.push('apiUrlHttpInterceptor'); //j'ai désactivé cette intercepteur car j'ai des probleme avec les lib angular externe qui utilisent $http, donc je remplace en dur dans les ressources ;)
    }]);
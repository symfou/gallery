/**
 * Created by majdi on 05/11/2016.
 */
(function(){
    'use strict';
    angular.module('BlurAdmin.theme')
        .filter('capitalize', capitalize);

    function capitalize(){
        return function(string){
            return string ? string.charAt(0).toUpperCase() + string.substr(1).toLowerCase() : '';
        };
    }

})();
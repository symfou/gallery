/**
 * Created by majdi on 05/11/2016.
 */
(function(){
    'use strict';
    angular.module('BlurAdmin.theme')
        .filter('normalizeLabel', normalizeLabel);

    function normalizeLabel(){
        return function(string){
            return string ? string.replace(/_/g, '') : '';
        };
    }

})();
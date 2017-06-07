/**
 * Created by majdi on 17/11/2016.
 */
(function () {
    'use strict';

    angular.module('BlurAdmin.theme')
        .filter('wbiImage', wbiImage);

    /** @ngInject */
    function wbiImage(API_IMAGE_PREFIX, DEFAULT_PRODUCT_IMAGE) {
        return function(relative_url, with_default) {
            if (typeof relative_url === 'undefined' && with_default){
                var url = API_IMAGE_PREFIX + DEFAULT_PRODUCT_IMAGE;
            }else{
                var url = API_IMAGE_PREFIX + relative_url;
            }
            return url;
        };
    }

})();

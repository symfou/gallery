/**
 * Created by majdi on 26/11/2016.
 */

/**
 * Created by majdi on 28/09/2016.
 */

angular.module('BlurAdmin')
    .controller('wbiController', function($scope, User, $location, $auth, toastr, OAUTH2, SatellizerShared, $window, $interval, oauth2) {
        //login before load
        function joinUrl(baseUrl, url) {
            if (/^(?:[a-z]+:)?\/\//i.test(url)) {
                return url;
            }
            var joined = [baseUrl, url].join('/');
            var normalize = function (str) {
                return str
                    .replace(/[\/]+/g, '/')
                    .replace(/\/\?/g, '?')
                    .replace(/\/\#/g, '#')
                    .replace(/\:\//g, '://');
            };
            return normalize(joined);
        }
        function getFullUrlPath(location) {
            var isHttps = location.protocol === 'https:';
            return location.protocol + '//' + location.hostname +
                ':' + (location.port || (isHttps ? '443' : '80')) +
                (/^\//.test(location.pathname) ? location.pathname : '/' + location.pathname);
        }
        function parseQueryString(str) {
            var obj = {};
            var key;
            var value;
            angular.forEach((str || '').split('&'), function (keyValue) {
                if (keyValue) {
                    value = keyValue.split('=');
                    key = decodeURIComponent(value[0]);
                    obj[key] = angular.isDefined(value[1]) ? decodeURIComponent(value[1]) : true;
                }
            });
            return obj;
        }
        function decodeBase64(str) {
            var buffer;
            if (typeof module !== 'undefined' && module.exports) {
                try {
                    buffer = require('buffer').Buffer;
                }
                catch (err) {
                }
            }
            var fromCharCode = String.fromCharCode;
            var re_btou = new RegExp([
                '[\xC0-\xDF][\x80-\xBF]',
                '[\xE0-\xEF][\x80-\xBF]{2}',
                '[\xF0-\xF7][\x80-\xBF]{3}'
            ].join('|'), 'g');
            var cb_btou = function (cccc) {
                switch (cccc.length) {
                    case 4:
                        var cp = ((0x07 & cccc.charCodeAt(0)) << 18)
                            | ((0x3f & cccc.charCodeAt(1)) << 12)
                            | ((0x3f & cccc.charCodeAt(2)) << 6)
                            | (0x3f & cccc.charCodeAt(3));
                        var offset = cp - 0x10000;
                        return (fromCharCode((offset >>> 10) + 0xD800)
                        + fromCharCode((offset & 0x3FF) + 0xDC00));
                    case 3:
                        return fromCharCode(((0x0f & cccc.charCodeAt(0)) << 12)
                            | ((0x3f & cccc.charCodeAt(1)) << 6)
                            | (0x3f & cccc.charCodeAt(2)));
                    default:
                        return fromCharCode(((0x1f & cccc.charCodeAt(0)) << 6)
                            | (0x3f & cccc.charCodeAt(1)));
                }
            };
            var btou = function (b) {
                return b.replace(re_btou, cb_btou);
            };
            var _decode = buffer ? function (a) {
                return (a.constructor === buffer.constructor
                    ? a : new buffer(a, 'base64')).toString();
            }
                : function (a) {
                return btou(atob(a));
            };
            return _decode(String(str).replace(/[-_]/g, function (m0) {
                    return m0 === '-' ? '+' : '/';
                })
                .replace(/[^A-Za-z0-9\+\/]/g, ''));
        }



        var loaction_polling = function (redirectUri) {
            var _this = this;
                var redirectUriParser = document.createElement('a');
                redirectUriParser.href = redirectUri;
                var redirectUriPath = getFullUrlPath(redirectUriParser);

                    /*if (!_this.popup || _this.popup.closed || _this.popup.closed === undefined) {
                        $interval.cancel(polling);
                        return (new Error('The popup window was closed'));
                    }*/
                    try {

                        var popupWindowPath = getFullUrlPath($window.location);
                        if (popupWindowPath === redirectUriPath) {
                            if ($window.location.search || $window.location.hash) {
                                var query = parseQueryString($window.location.search.substring(1).replace(/\/$/, ''));
                                var hash = parseQueryString($window.location.hash.substring(1).replace(/[\/$]/, ''));
                                var params = angular.extend({}, query, hash);
                                if (params.error) {
                                    return (new Error(params.error));
                                }
                                else {
                                    SatellizerShared.setToken(params);

                                }
                            }
                            else {
                                retuen (new Error('OAuth redirect has occurred but no query or hash parameters were found. ' +
                                    'They were either not set during the redirect, or were removed—typically by a ' +
                                    'routing library—before Satellizer could read it.'));
                            }
                            // _this.popup.close();
                        }
                    }
                    catch (error) {
                        // alert(error);
                    }
        };


        loaction_polling($window.location);
        User.checkUser();
        if ($auth.isAuthenticated()){
            toastr.success('You have successfully signed in!');
        }else{
            $window.location.replace(oauth2.url);
        }
        

    });

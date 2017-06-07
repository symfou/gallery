/**
 * Created by majdi on 27/11/2016.
 */
angular.module('BlurAdmin')
    .factory("oauth2", function ProductsFactory($location, $window, OAUTH2) {

        function addParameter(url, parameterName, parameterValue, atStart/*Add param before others*/){
            replaceDuplicates = true;
            if(url.indexOf('#') > 0){
                var cl = url.indexOf('#');
                urlhash = url.substring(url.indexOf('#'),url.length);
            } else {
                urlhash = '';
                cl = url.length;
            }
            sourceUrl = url.substring(0,cl);

            var urlParts = sourceUrl.split("?");
            var newQueryString = "";

            if (urlParts.length > 1)
            {
                var parameters = urlParts[1].split("&");
                for (var i=0; (i < parameters.length); i++)
                {
                    var parameterParts = parameters[i].split("=");
                    if (!(replaceDuplicates && parameterParts[0] == parameterName))
                    {
                        if (newQueryString == "")
                            newQueryString = "?";
                        else
                            newQueryString += "&";
                        newQueryString += parameterParts[0] + "=" + (parameterParts[1]?parameterParts[1]:'');
                    }
                }
            }
            if (newQueryString == "")
                newQueryString = "?";

            if (urlParts[0].slice(-1) === '/'){
                urlParts[0] = urlParts[0].slice(0, -1);
            }

            if(atStart){
                newQueryString = '?'+ parameterName + "=" + parameterValue + (newQueryString.length>1?'&'+newQueryString.substring(1):'');
            } else {
                if (newQueryString !== "" && newQueryString != '?')
                    newQueryString += "&";
                newQueryString += parameterName + "=" + (parameterValue?parameterValue:'');
            }
            return urlParts[0] + newQueryString + urlhash;
        }



        var getAuthUrl = function (location) {
            var redirect_uri =  $window.location;
            if (location && !angular.isUndefined(location)){
                var redirect_uri = location;
            }

            var url = addParameter(OAUTH2.AUTH_URL, 'client_id', OAUTH2.CLIENT_ID);
            url = addParameter(url, 'response_type', OAUTH2.RESPENSE_TYPE);
            url = addParameter(url, 'redirect_uri', redirect_uri);

            return url;
        };
        

        return {
            url: getAuthUrl()
        }
    });
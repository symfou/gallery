/**
 * Created by majdi on 28/09/2016.
 */

angular.module('BlurAdmin.pages.login')
    .controller('LoginPageCtrl', function($scope, $location, $auth, toastr, OAUTH2) {
        $scope.user = {};
        $scope.login = function() {


            $scope.user.client_id = OAUTH2.CLIENT_ID;
            $scope.user.client_secret = OAUTH2.CLIENT_SECRET;
            $scope.user.grant_type = OAUTH2.GRANT_TYPE;
            //console.log($scope.user);

            $auth.login($scope.user)
                .then(function() {
                    toastr.success('You have successfully signed in!');
                    $location.path('/');
                })
                .catch(function(error) {
                    toastr.error(error.data.message, error.status);
                });
        };
        $scope.authenticate = function(provider) {
            $auth.authenticate(provider)
                .then(function() {
                    toastr.success('You have successfully signed in with ' + provider + '!');
                    $location.path('/');
                })
                .catch(function(error) {
                    if (error.message) {
                        // Satellizer promise reject error.
                        toastr.error(error.message);
                    } else if (error.data) {
                        // HTTP response error from server
                        toastr.error(error.data.message, error.status);
                    } else {
                        toastr.error(error);
                    }
                });
        };
    });

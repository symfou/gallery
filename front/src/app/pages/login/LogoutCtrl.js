/**
 * Created by majdi on 28/09/2016.
 */
angular.module('BlurAdmin.pages.login')
    .controller('LogoutCtrl', function($window, $auth, toastr, OAUTH2) {
        if (!$auth.isAuthenticated()) { return; }
        $auth.logout()
            .then(function() {
                toastr.info('You have been logged out');
                $window.location.replace(OAUTH2.AUTH_SIGNOUT_URL);
            });
    });
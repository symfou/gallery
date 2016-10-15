/**
 * Created by majdi on 28/09/2016.
 */
angular.module('BlurAdmin.pages.login')
    .controller('LogoutCtrl', function($location, $auth, toastr) {
        if (!$auth.isAuthenticated()) { return; }
        $auth.logout()
            .then(function() {
                toastr.info('You have been logged out');
                $location.path('/');
            });
    });
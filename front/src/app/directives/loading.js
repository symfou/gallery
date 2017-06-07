/**
 * Created by majdi on 29/09/2016.
 */
angular.module('BlurAdmin')
    .directive('wbiSpinner', function ($http, $rootScope, ngProgressFactory){
        return {
            restrict: 'A',
            link: function (scope, elm, attrs)
            {
                if(attrs.$attr.wbiSpinnerStandalone) return;
                $rootScope.spinnerActive = false;
                scope.isLoading = function () {
                    return $http.pendingRequests.length > 0;
                };
                scope.numberRequest = function () {
                    return $http.pendingRequests.length;
                };

                /*scope.$watch(scope.isLoading, function (loading)
                {
                    $rootScope.spinnerActive = loading;
                    if(loading){
                        elm.removeClass('ng-hide');
                    }else{
                        elm.addClass('ng-hide');
                    }
                });*/
                scope.progressbar = ngProgressFactory.createInstance();
                scope.progressbar.setColor('#b91f1f');
                var e = scope.progressbar.addProgressElementClass('progressing');
                scope.progressbar.setHeight('5px');


                scope.$watch(scope.isLoading, function (newV)
                {

                    if(newV){
                        scope.progressbar.start();
                        // var totalRequest = scope.numberRequest;
                        // var step = Math.floor((100 / totalRequest) / 4);
                        // scope.$watch(scope.numberRequest, function (newV) {
                        //     scope.progressbar.set(step);
                        // })
                    }else{
                        scope.progressbar.complete();
                    }
                });

            }
        };

    });
/**
 * @author a.demeshko
 * created on 18.01.2016
 */
(function () {
  'use strict';

  angular.module('BlurAdmin.pages.ui.modals')
      .controller('ModalDemoCtrl', function ($uibModal, $log, $document) {
        var $ctrl = this;
        $ctrl.items = ['item1', 'item2', 'item3'];

        $ctrl.animationsEnabled = true;

        $ctrl.open = function (size, parentSelector) {
          var parentElem = parentSelector ?
              angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
          var modalInstance = $uibModal.open({
            animation: $ctrl.animationsEnabled,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'myModalContent.html',
            controller: 'ModalInstanceCtrl',
            controllerAs: '$ctrl',
            size: size,
            appendTo: parentElem,
            resolve: {
              items: function () {
                return $ctrl.items;
              }
            }
          });

          modalInstance.result.then(function (selectedItem) {
            $ctrl.selected = selectedItem;
          }, function () {
            $log.info('Modal dismissed at: ' + new Date());
          });
        };





        $ctrl.toggleAnimation = function () {
          $ctrl.animationsEnabled = !$ctrl.animationsEnabled;
        };
      })



  .controller('ModalInstanceCtrl', function ($uibModalInstance, items) {
    var $ctrl = this;
    $ctrl.items = items;
    $ctrl.selected = {
      item: $ctrl.items[0]
    };

    $ctrl.ok = function () {
      $uibModalInstance.close($ctrl.selected.item);
    };

    $ctrl.cancel = function () {
      $uibModalInstance.dismiss('cancel');
    };
  });

})();
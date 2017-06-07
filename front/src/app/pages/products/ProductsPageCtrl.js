/**
 * Created by majdi on 28/09/2016.
 */

angular.module('BlurAdmin.pages.products')



    .controller('ProductsPageCtrl', function($scope, $location, $auth, toastr, $http, Products) {
        var controller = this;
        // $scope = {};
        $scope.title = 'Product list';
        $scope.$watch('product.is_published', function (value) {
            console.log(value);
        });
        Products.all()
         .success(function(data){
            $scope.products = data;
             toastr.success("success");
        }).error(function (error) {
            toastr.error('error');
        });

    })

    .controller('ProductCtrl', function($scope, $stateParams, $auth, toastr, $http, Products) {
        $scope.$watch('product.is_published', function (newValue, oldValue, scope) {
            var product = scope.$parent.product;
            if (newValue != oldValue) {
                Products.patch({'product_type': {'is_published': newValue}}, product.id).success(function (data) {
                    toastr.success("success");
                }).error(function (error) {
                    toastr.error('error');
                    scope = oldValue;
                });
            }
        })
    })

    .controller('ProductDetailCtrl', function($scope, $http, $stateParams, toastr, Products){
        var controller = this;
        Products.find($stateParams.id)
        .success(function(data){
            controller.product = data;
            toastr.success("success");
        }).error(function (error) {
            toastr.error('error');
        });
    })



.controller("ProductCreateCtrl", function($scope, $http, toastr, Products, Upload, $timeout, $state){
    $scope.product = {};
    $scope.errors = {};
    $scope.createProduct = function(product, productEditForm){
        Products.create({'product_type':product}).success(function(data, status, headers, config){
            toastr.success("success");
            $state.go('products.edit', {id: data.id});
        }).error(function (error, status) {
            if (status === 400){
                toastr.error(error.message);
                var errors = error.errors.children;
                angular.forEach(errors, function (error, field) {
                    if (!angular.equals(error, {}) && !angular.equals(error.errors, {}) && !angular.isUndefined(error.errors)) {
                        productEditForm[field].$setValidity('serverError', false);
                        $scope.errors[field] = error.errors.join(', ');
                    }
                });
            }

        });
    };

})



    .controller("ProductUpdatePutCtrl", function($scope, $http, toastr, Products, $stateParams, Upload, $timeout, $uibModal, wbiImageFilter){
    var controller = this;


        $scope.clickMainImage = function () {
            var fileInput = document.getElementById('uploadMainImage');
            fileInput.click();
        };

        $scope.removeMainImage = function (gallery) {
            Products.deleteImage(gallery.id)
                .then(function (response) {
                    $timeout(function () {
                        $scope.croppedFile = "";
                        $scope.product.image = "";
                    });
                }, function (response) {
                    toastr.error(response.data);
                }, function (evt) {
                });
        }

        controller.getProduct = function(){
            Products.find($stateParams.id)
                .success(function(data){
                    //deleting fields
                    delete data.created_at;
                    delete data.updated_at;
                    delete data.gallerys;
                    $scope.product = data;

                    toastr.success("success");
                }).error(function (error) {
                toastr.error('error');
            });
        };


        controller.getProductGallery = function(){
            Products.getProductGallery($stateParams.id)
                .success(function(data){
                    var gallerys = data;
                    $scope.thumbnails = [];
                    angular.forEach(gallerys, function(gallery){
                        Upload.urlToBlob(wbiImageFilter(gallery.url)).then(function(blob) {
                            blob.gallery = gallery;
                            $scope.thumbnails.push(blob);
                        });
                    });
                    //deleting fields
                    delete data.created_at;
                    delete data.updated_at;
                    $scope.gallerys = data;
                }).error(function (error) {
                toastr.error('error');
            });
        };

        // $scope.errors = {};
        controller.getProduct();
        controller.getProductGallery();

        controller.parseErrors = function(errors, productEditForm){
            var childrens = errors.children;
            if (!angular.isUndefined(childrens) && !angular.equals(childrens, {})){
                angular.forEach(childrens, function (error, field) {
                    if (!angular.equals(error, {}) && !angular.equals(error.errors, {}) && !angular.isUndefined(error.errors)) {
                        productEditForm[field].$setValidity('serverError', false);
                        $scope.errors[field] = error.errors.join(', ');
                    }else if((!angular.equals(error, {}) && !angular.equals(error.children, {}) && !angular.isUndefined(error.children))){
                        controller.parseErrors(error, productEditForm);
                    }
                });
            }
        };


        $scope.updatePutProduct = function(productEditForm){
            var product = $scope.product;
            Products.put({'product_type':product}, $stateParams.id)
                .success(function(data){
                    // controller.getProduct(); //TODO cette get est toujours avant l'update bizarre
                    toastr.success("success");
            })
                .error(function (error) {
                    if (error.code === 400){
                        toastr.error(error.message);
                        controller.parseErrors(error.errors, productEditForm);
                    }
            });
        };



        $scope.selectImage = function(files, file, newFiles, duplicateFiles, invalidFiles, event){
            $scope.errFiles = invalidFiles;
            if ((!angular.isUndefined(newFiles) && null != newFiles) || (!angular.isUndefined(invalidFiles) && null != invalidFiles) ){
                if (invalidFiles.length === 0){
                    if (!$scope.thumbnails){ $scope.thumbnails = [] }
                    angular.forEach(newFiles, function (newFile) {
                        $scope.uploadFile(newFile, newFile.name, invalidFiles);
                    })
                }else {
                    angular.forEach(invalidFiles, function (invalidFile, key) {
                        toastr.error(invalidFile.name + " Invalid");
                    })
                }

            }
        };
        


        $scope.uploadFile = function(croppedDataUrl, name, invalidFiles) {
                var length = $scope.thumbnails.push(croppedDataUrl);
                $scope.thumbnails[length-1].upload = Products.upload($scope.thumbnails[length-1], $stateParams.id);
                $scope.thumbnails[length-1].upload.then(function (response, status) {
                    $timeout(function () {
                        $scope.thumbnails[length-1].gallery = response.data;
                        delete $scope.errorMsg;
                    });
                }, function (response) {
                    if (response.status === 400){
                        $scope.errorMsg = response.data.errors.errors[0];
                        $scope.thumbnails.pop();
                        toastr.error($scope.errorMsg);
                    }
                }, function (evt) {
                    $scope.thumbnails[length-1].progress = Math.min(100, parseInt(100.0 *
                        evt.loaded / evt.total));
                    $scope.thumbnails[length-1].progressCss = $scope.thumbnails[length-1].progress+"%";
                });
        };



        $scope.selectMainImage = function(files, file, newFiles, duplicateFiles, invalidFiles, event){
            $scope.errFiles = invalidFiles;
            if ((!angular.isUndefined(files) && null != files && files.length > 0) || (!angular.isUndefined(invalidFiles) && null != invalidFiles) ){
                if (invalidFiles.length === 0){
                    $scope.file = files[0];
                    if (!angular.isUndefined($scope.file)){
                        $uibModal.open({
                            animation: true,
                            templateUrl: "app/pages/products/templates/_cropImage.html",
                            // size: size,
                            controller: function ($scope, $uibModalInstance, file, fileType, uploadFile, invalidFiles) {
                                $scope.file = file;
                                $scope.fileType = fileType;
                                $scope.uploadFile = uploadFile;
                                $scope.invalidFiles = invalidFiles;

                                $scope.ok = function (croppedDataUrl, file, name, invalidFiles) {
                                    croppedDataUrl = Upload.dataUrltoBlob(croppedDataUrl, name);
                                    $uibModalInstance.close($scope.uploadFile(croppedDataUrl, file, name, invalidFiles));
                                };
                                $scope.cancel = function () {
                                    $uibModalInstance.dismiss('cancel');
                                };
                            },
                            controllerAs: "$ctrl",
                            resolve: {
                                file: function () {
                                    return $scope.file;
                                },
                                fileType: function () {
                                    return $scope.file.type;
                                },
                                uploadFile: function () {
                                    return $scope.uploadMainImage;
                                },
                                invalidFiles: function () {
                                    return $scope.invalidFiles;
                                }
                            }
                        });
                    }

                }else {
                    angular.forEach(invalidFiles, function (invalidFile, key) {
                        toastr.error(invalidFile.name + " Invalid");
                    })
                }
            }
        };


        $scope.uploadMainImage = function(croppedDataUrl, file, name, invalidFiles) {

                $scope.croppedFile = croppedDataUrl;
                $scope.croppedFile.upload = Products.upload($scope.croppedFile, $stateParams.id, true);
                $scope.croppedFile.upload.then(function (response, status) {
                    //delete old iamge
                    $scope.deleteImage($scope.product.image);
                    $timeout(function () {
                        $scope.croppedFile.gallery = response.data;
                        $scope.product.image = response.data;
                        delete $scope.errorMsg;
                    });
                }, function (response) {
                    if (response.status === 400){
                        $scope.errorMsg = response.data.errors.errors[0];
                        $scope.thumbnails.pop();
                        toastr.error($scope.errorMsg);
                    }
                }, function (evt) {
                    $scope.croppedFile.progress = Math.min(100, parseInt(100.0 *
                        evt.loaded / evt.total));
                    $scope.croppedFile.progressCss = $scope.croppedFile.progress+"%";
                });
        };








        $scope.deleteImage = function(gallery, key){
            if (typeof gallery === 'undefined'){
                document.getElementById('product-thumbnail-'+key).remove();
            }else{
                Products.deleteImage(gallery.id)
                    .then(function (response) {
                        $timeout(function () {
                            var thumpIndex = $scope.thumbnails.findIndex(function(elem){
                                return elem.gallery.id == response.data.id;
                            });
                            if (thumpIndex > -1) {
                                $scope.thumbnails.splice(thumpIndex, 1);
                            }
                        });
                    }, function (response) {
                        toastr.error(response.data);
                    }, function (evt) {
                    });
            }
        };



        // upload multiples images
        /*$scope.uploadFiles = function(files, file, newFiles, duplicateFiles, invalidFiles, event) {
            $scope.newFiles = newFiles;
            $scope.errFiles = invalidFiles;
            angular.forEach(newFiles, function(file) {
                file.upload = Products.upload(file, $stateParams.id);

                file.upload.then(function (response, status) {
                    $timeout(function () {
                        file.result = response;
                    });
                }, function (response, status) {
                    if (true)
                        $scope.errorMsg = response.data.errors.errors[0];
                }, function (evt) {
                    file.progress = Math.min(100, parseInt(100.0 *
                        evt.loaded / evt.total));
                });
            });
        };*/
    })


    .controller('FileCtrl', function($scope, $stateParams, $timeout, toastr, $http, Products) {
        $scope.setDefaultImage = function(is_default, gallery_id) {
            Products.setDefaultImage({'is_default': is_default}, gallery_id)
                .then(function (response) {
                    $timeout(function () {
                    });
                }, function (response) {
                    toastr.error(response.data);
                }, function (evt) {
                });
            if (is_default == true){
                angular.forEach($scope.$parent.thumbnails, function (file) {
                    if (file.gallery.id != gallery_id){
                        file.gallery.is_default = false;
                        $scope.setDefaultImage(file.gallery.is_default, file.gallery.id);
                    }
                })
            }
        };
        
        /*$scope.$watch('product.is_published', function (newValue, oldValue, scope) {
            var product = scope.$parent.product;
            if (newValue != oldValue) {
                Products.patch({'product_type': {'is_published': newValue}}, product.id).success(function (data) {
                    toastr.success("success");
                }).error(function (error) {
                    toastr.error('error');
                    scope = oldValue;
                });
            }
        })*/
    })


;

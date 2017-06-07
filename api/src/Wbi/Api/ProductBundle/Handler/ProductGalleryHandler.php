<?php

namespace Wbi\Api\ProductBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\Security;
use Wbi\Api\ProductBundle\Entity\ProductGallery;
use Wbi\Api\ProductBundle\Form\ProductGalleryType;
use Wbi\Api\ProductBundle\Model\ProductGalleryInterface;
use Wbi\Api\ProductBundle\Model\ProductInterface;
use Wbi\Api\ProductBundle\Form\ProductType;
use Wbi\Api\ProductBundle\Exception\InvalidFormException;


class ProductGalleryHandler implements ProductHandlerInterface
{
    private $om;
    private $repository;
    private $uploader;
    private $entityClass;
    private $formFactory;
    private $product_max_upload_file;
    private $security;

    public function __construct(ObjectManager $om, $entityClass, $uploader, $formFactory, $product_max_upload_file, Security $security)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->uploader = $uploader;
        $this->formFactory = $formFactory;
        $this->product_max_upload_file = $product_max_upload_file;
        $this->security = $security;
    }

    /**
     * Get a product.
     *
     * @param mixed $id
     *
     * @return ProductInterface
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Get a list of products.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 100, $offset = 0)
    {
        return $this->repository->findBy(array(), null, $limit, $offset);
    }


    /**
     * Get a list of products.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function getGallerysByProduct($id)
    {
        return $this->repository->getGallerysByProduct($id);
    }

    /**
     * Create a new product.
     *
     * @param array $parameters
     *
     * @return ProductInterface
     */
    public function post(array $parameters)
    {
        $product = $this->createProduct();

        return $this->processForm($product, $parameters, 'POST');
    }



    /**
     * Upload Images.
     *
     * @param array $parameters
     *
     * @return ProductInterface
     */
    public function uploadImage(ProductInterface $product, $file, $isDefault = false)
    {

        if (empty($file)){
            throw new \Exception('File is required');
        }
        $gallery = new ProductGallery();
        $gallery->setProduct($product);
        $gallery->setUrl($file);

        $form = $this->formFactory->create(new ProductGalleryType(), $gallery, array('method' => 'PATCH'));



        $form->submit(array('url' => $file), true);


        if ($isDefault != true){
            if (count($this->getGallerysByProduct($product->getId())) >= $this->product_max_upload_file){
                $form->get('url')->addError(new FormError(sprintf("%d files allowed", $this->product_max_upload_file)));
            }
        }

        if ($form->isValid()) {
            $gallery = $form->getData();
            $gallery->setName($file->getClientOriginalName());
            if ($isDefault == true){
                $gallery->setIsDefault(true);
            }
            $this->om->persist($gallery);
            $this->uploader->markEntityToUpload($gallery, $gallery->getUrl());
            $this->om->flush($gallery);


            if ($isDefault == true){
                $product->setImage($gallery);
                $this->om->persist($product);
                $this->om->flush($product);
            }

            return $gallery;
        }

        throw new InvalidFormException('Invalid submitted data', $form->get('url'));
    }
   



    /**
     * Upload Images.
     *
     * @param array $parameters
     *
     * @return ProductInterface
     */
    public function deleteImage(ProductGalleryInterface $gallery)
    {
        $this->om->remove($gallery);
        $this->om->flush();

    }


    /**
     * Upload Images.
     *
     * @param array $parameters
     *
     * @return ProductInterface
     */
    public function defaultImage(ProductGalleryInterface $gallery, $isDefault)
    {
        if (isset($isDefault)){
            $gallery->setIsDefault($isDefault);
            $product = $gallery->getProduct();
            if ($isDefault == true){
//                $product->setImage($gallery);
            }
            $this->om->persist($gallery);
            $this->om->flush();
        }else{
            throw new InvalidFormException('Invalid submitted data');
        }
    }

    /**
     * Edit a product.
     *
     * @param ProductInterface $product
     * @param array         $parameters
     *
     * @return ProductInterface
     */
    public function put(ProductInterface $product, array $parameters)
    {
        return $this->processForm($product, $parameters, 'PUT');
    }

    /**
     * Partially update a product.
     *
     * @param ProductInterface $product
     * @param array         $parameters
     *
     * @return ProductInterface
     */
    public function patch(ProductInterface $product, array $parameters)
    {
        return $this->processForm($product, $parameters, 'PATCH');
    }

    /**
     * Processes the form.
     *
     * @param ProductInterface $product
     * @param array         $parameters
     * @param String        $method
     *
     * @return ProductInterface
     *
     * @throws \Acme\BlogBundle\Exception\InvalidFormException
     */
    private function processForm(ProductInterface $product, array $parameters, $method = "PUT")
    {
        /*$form = $this->formFactory->create('product_type', $product, array(
            'method' => $method,
            'isNew' => $product->getId() ? false : true
        ));
        $form->submit($parameters, "PATCH" !== $method);
        if ($form->isValid()) {

            $product = $form->getData();
            $this->om->persist($product);
            $this->om->flush($product);

            return $product;
        }

        throw new InvalidFormException('Invalid submitted data', $form);*/
    }

    private function createProduct()
    {
        return new $this->entityClass();
    }

}
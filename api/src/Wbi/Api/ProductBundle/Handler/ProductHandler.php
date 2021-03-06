<?php

namespace Wbi\Api\ProductBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\Security;
use Wbi\Api\ProductBundle\Entity\ProductGallery;
use Wbi\Api\ProductBundle\Form\ProductGalleryType;
use Wbi\Api\ProductBundle\Model\ProductInterface;
use Wbi\Api\ProductBundle\Form\ProductType;
use Wbi\Api\ProductBundle\Exception\InvalidFormException;


class ProductHandler implements ProductHandlerInterface
{
    private $om;
    private $entityClass;
    private $repository;
    private $formFactory;
    private $uploader;
    private $security;
    

    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory, $uploader, $security)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
        $this->uploader = $uploader;
        $this->security = $security;
        $this->user = $security->getToken()->getUser();
        
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
        return $this->repository->findBy(['id' => $id, 'user_id' => $this->user->getId()]);
    }

    /**
     * Get a list of products.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0)
    {
        return $this->repository->findBy(array(), null, $limit, $offset);
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
        $form = $this->formFactory->create('product_type', $product, array(
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

        throw new InvalidFormException('Invalid submitted data', $form);
    }

    private function createProduct()
    {
        return new $this->entityClass();
    }

}
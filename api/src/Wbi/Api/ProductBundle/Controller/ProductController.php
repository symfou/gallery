<?php

namespace Wbi\Api\ProductBundle\Controller; 

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;

use Symfony\Component\Form\FormTypeInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Wbi\Api\ProductBundle\Exception\InvalidFormException;
use Wbi\Api\ProductBundle\Form\ProductType;
use Wbi\Api\ProductBundle\Model\ProductInterface;


class ProductController extends FOSRestController
{
    /**
     * List all products.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing products.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="5", description="How many products to return.")
     *
     * @Annotations\View(
     *  templateVar="products"
     * )
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getProductsAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $offset = null == $offset ? 0 : $offset;
        $limit = $paramFetcher->get('limit');

        return $this->container->get('wbi_api_product.product.handler')->all($limit, $offset);
    }

    /**
     * Get single Product.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a Product for a given id",
     *   output = "Wbi\Api\ProductBundle\Entity\Product",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the product is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="product")
     *
     * @param int     $id      the product id
     *
     * @return array
     *
     * @throws NotFoundHttpException when product not exist
     */
    public function getProductAction($id)
    {
        $product = $this->getOr404($id);

        return $product;
    }

    /**
     * Presents the form to use to create a new product.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  templateVar = "form"
     * )
     *
     * @return FormTypeInterface
     */
    public function newProductAction()
    {
        return $this->createForm(new ProductType());
    }

    /**
     * Create a Product from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new product from the submitted data.",
     *   input = "Wbi\Api\ProductBundle\Form\ProductType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AcmeBlogBundle:Product:newProduct.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postProductAction(Request $request)
    {
        $form = new ProductType('');
        try {
            $newProduct = $this->container->get('wbi_api_product.product.handler')->post(
                $request->request->get($form->getName())
            );

            $routeOptions = array(
                'id' => $newProduct->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_product_get_product', $routeOptions, Codes::HTTP_CREATED);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing product from the submitted data or create a new product at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Acme\DemoBundle\Form\ProductType",
     *   statusCodes = {
     *     201 = "Returned when the Product is created",
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AcmeBlogBundle:Product:editProduct.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the product id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when product not exist
     */
    public function putProductAction(Request $request, $id)
    {
        try {
            if (!($product = $this->container->get('wbi_api_product.product.handler')->get($id))) {
                $statusCode = Codes::HTTP_CREATED;
                $product = $this->container->get('wbi_api_product.product.handler')->post(
                    $request->request->get($form->getName())
                );
            } else {
                $statusCode = Codes::HTTP_NO_CONTENT;
                $product = $this->container->get('wbi_api_product.product.handler')->put(
                    $product,
                    $request->request->all()
                );
            }

            $routeOptions = array(
                'id' => $product->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_product', $routeOptions, $statusCode);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing product from the submitted data or create a new product at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Acme\DemoBundle\Form\ProductType",
     *   statusCodes = {
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AcmeBlogBundle:Product:editProduct.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the product id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when product not exist
     */
    public function patchProductAction(Request $request, $id)
    {
        try {
            $product = $this->container->get('wbi_api_product.product.handler')->patch(
                $this->getOr404($id),
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $product->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_product', $routeOptions, Codes::HTTP_NO_CONTENT);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Fetch a Product or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return ProductInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($product = $this->container->get('wbi_api_product.product.handler')->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }

        return $product;
    }
}
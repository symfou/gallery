<?php
/**
 * Class ProductGalleryController
 *
 * @category
 * @package Wbi\Api\ProductBundle\Controller
 * @author Boumaiza Majdi <boumaiza.majdi@mail.com>
 */


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

use Wbi\Api\ProductBundle\Entity\Product;
use Wbi\Api\ProductBundle\Exception\InvalidFormException;
use Wbi\Api\ProductBundle\Form\ProductGalleryType;
use Wbi\Api\ProductBundle\Form\ProductType;
use Wbi\Api\ProductBundle\Model\ProductInterface;
use FOS\RestBundle\Controller\Annotations as fos;


class ProductGalleryController extends FOSRestController
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
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="20", description="How many products to return.")
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
    public function getGallerysAction(Request $request, $id)
    {
        $gallerys =  $this->container->get('wbi_api_product.product.gallery.handler')->getGallerysByProduct($id);
        return $gallerys;
    }

    /**
     * Upload file from submitted data
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Upload file from submitted data.",
     *   input = "Wbi\Api\ProductBundle\Form\ProductGalleryType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     * @fos\Post("/products/{id}/upload/image")
     */
    public function uploadImageAction(Request $request, $id)
    {
        try {
            $form = new ProductGalleryType();

            if (!($product = $this->container->get('wbi_api_product.product.handler')->get($id))) {
                throw new InvalidFormException('Invalid product id', $form);
            } else {
                $statusCode = Codes::HTTP_NO_CONTENT;
                $gallery = $this->container->get('wbi_api_product.product.gallery.handler')->uploadImage(
                    $product,
                    $request->files->get('file'),
                    $request->get('is_default')
                );
            }

            $view = $this->view($gallery, 200);
            return $this->handleView($view);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * delete image
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Upload file from submitted data.",
     *   input = "Wbi\Api\ProductBundle\Form\ProductGalleryType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     * @fos\Delete("/products/{gallery_id}/delete/image")
     */
    public function deleteImageAction(Request $request, $gallery_id)
    {
        try {
            $form = new ProductGalleryType();

            if (!($gallery = $this->container->get('wbi_api_product.product.gallery.handler')->get($gallery_id))) {
                throw new InvalidFormException('Gallery not found');
            } else {
                $gallery = $this->container->get('wbi_api_product.product.gallery.handler')->deleteImage(
                    $gallery
                );
            }

            $view = $this->view(array('id' => $gallery_id), 200);
            return $this->handleView($view);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }




    /**
     * delete image
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Upload file from submitted data.",
     *   input = "Wbi\Api\ProductBundle\Form\ProductGalleryType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     * @fos\Patch("/products/{gallery_id}/default/image")
     */
    public function defaultImageAction(Request $request, $gallery_id)
    {
        try {
            $form = new ProductGalleryType();

            if (!($gallery = $this->container->get('wbi_api_product.product.gallery.handler')->get($gallery_id))) {
                throw new InvalidFormException('Gallery not found');
            } else {
                $gallery = $this->container->get('wbi_api_product.product.gallery.handler')->defaultImage(
                    $gallery,
                    $request->request->get('is_default')
                );
            }

            $view = $this->view(array('id' => $gallery_id), 200);
            return $this->handleView($view);

        } catch (InvalidFormException $exception) {

            return $exception->getMessage();
        }
    }

}
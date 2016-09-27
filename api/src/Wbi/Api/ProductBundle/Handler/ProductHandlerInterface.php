<?php
/**
 * Created by PhpStorm.
 * User: majdi
 * Date: 25/09/2016
 * Time: 03:39
 */

namespace Wbi\Api\ProductBundle\Handler;

use Wbi\Api\ProductBundle\Model\ProductInterface;

interface ProductHandlerInterface
{
    /**
     * Get a Product given the identifier
     *
     * @api
     *
     * @param mixed $id
     *
     * @return ProductInterface
     */
    public function get($id);

    /**
     * Get a list of Products.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0);

    /**
     * Post Product, creates a new Product.
     *
     * @api
     *
     * @param array $parameters
     *
     * @return ProductInterface
     */
    public function post(array $parameters);

    /**
     * Edit a Product.
     *
     * @api
     *
     * @param ProductInterface   $product
     * @param array           $parameters
     *
     * @return ProductInterface
     */
    public function put(ProductInterface $product, array $parameters);

    /**
     * Partially update a Product.
     *
     * @api
     *
     * @param ProductInterface   $product
     * @param array           $parameters
     *
     * @return ProductInterface
     */
    public function patch(ProductInterface $product, array $parameters);
}
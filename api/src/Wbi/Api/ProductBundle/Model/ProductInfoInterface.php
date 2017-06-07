<?php
/**
 * Created by PhpStorm.
 * User: majdi
 * Date: 09/11/2016
 * Time: 12:48
 */
namespace Wbi\Api\ProductBundle\Model;

use Wbi\Api\ProductBundle\Entity\date;




interface ProductInfoInterface
{
    /**
     * @return 
     */
    public function getProduct();

    /**
     * @param $product
     */
    public function setProduct(ProductInterface $product);

    /**
     * Get id
     *
     * @return int
     */
    public function getId();

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ProductInterface
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * @return date
     */
    public function getCreatedAt();

    /**
     * @return date
     */
    public function getUpdatedAt();

    /**
     * Set price
     *
     * @param string $price
     *
     * @return ProductInterface
     */
    public function setPrice($price);

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice();

    /**
     * Set vatRate
     *
     * @param string $vatRate
     *
     * @return ProductInterface
     */
    public function setVatRate($vatRate);

    /**
     * Get vatRate
     *
     * @return string
     */
    public function getVatRate();

    /**
     * Set stock
     *
     * @param integer $stock
     *
     * @return ProductInterface
     */
    public function setStock($stock);

    /**
     * Get stock
     *
     * @return integer
     */
    public function getStock();

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ProductInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return ProductInterface
     */
    public function setUpdatedAt($updatedAt);
}
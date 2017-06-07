<?php
/**
 * Created by PhpStorm.
 * User: majdi
 * Date: 09/11/2016
 * Time: 12:49
 */
namespace Wbi\Api\ProductBundle\Model;

use Wbi\Api\ProductBundle\Entity\ProductGallery;
use Wbi\Api\ProductBundle\Entity\Region;



interface ProductGalleryInterface
{
    /**
     * @return Region
     */
    public function getProduct();

    /**
     * @param Region $product
     */
    public function setProduct(ProductInterface $product);

    /**
     * Get id
     *
     * @return int
     */
    public function getId();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ProductGallery
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set type
     *
     * @param string $type
     *
     * @return ProductGallery
     */
    public function setType($type);

    /**
     * Get type
     *
     * @return string
     */
    public function getType();

    /**
     * Set extention
     *
     * @param string $extention
     *
     * @return ProductGallery
     */
    public function setExtention($extention);

    /**
     * Get extention
     *
     * @return string
     */
    public function getExtention();

    /**
     * Set url
     *
     * @param string $url
     *
     * @return ProductGallery
     */
    public function setUrl($url);

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl();

    /**
     * Set thumbnailUrl
     *
     * @param string $thumbnailUrl
     *
     * @return ProductGallery
     */
    public function setThumbnailUrl($thumbnailUrl);

    /**
     * Get thumbnailUrl
     *
     * @return string
     */
    public function getThumbnailUrl();

    /**
     * Set folder
     *
     * @param string $folder
     *
     * @return ProductGallery
     */
    public function setFolder($folder);

    /**
     * Get folder
     *
     * @return string
     */
    public function getFolder();
}
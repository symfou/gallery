<?php
/**
 * Copyright (c) 2016. $name
 */

/**
 * Created by PhpStorm.
 * User: majdi
 * Date: 01/10/2016
 * Time: 02:49
 */
namespace Wbi\Api\ProductBundle\Model;

use Wbi\Api\ProductBundle\Entity\date;
use Wbi\Api\ProductBundle\Entity\GalleryInterface;


interface ProductInterface
{
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
     * @return ProductInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

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
     * Set image
     *
     * @param string $image
     *
     * @return ProductInterface
     */
    public function setImage($image);

    /**
     * Get image
     *
     * @return string
     */
    public function getImage();

    /**
     * @return date
     */
    public function getCreatedAt();

    /**
     * @return date
     */
    public function getUpdatedAt();

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return ProductInterface
     */
    public function setSlug($slug);

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug();

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     *
     * @return ProductInterface
     */
    public function setShortDescription($shortDescription);

    /**
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription();

    /**
     * Set code
     *
     * @param string $code
     *
     * @return ProductInterface
     */
    public function setCode($code);

    /**
     * Get code
     *
     * @return string
     */
    public function getCode();

    /**
     * Set availableOn
     *
     * @param \DateTime $availableOn
     *
     * @return ProductInterface
     */
    public function setAvailableOn($availableOn);

    /**
     * Get availableOn
     *
     * @return \DateTime
     */
    public function getAvailableOn();

    /**
     * Set availableUntil
     *
     * @param \DateTime $availableUntil
     *
     * @return ProductInterface
     */
    public function setAvailableUntil($availableUntil);

    /**
     * Get availableUntil
     *
     * @return \DateTime
     */
    public function getAvailableUntil();

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
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return ProductInterface
     */
    public function setIsEnabled($enabled);

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getIsEnabled();

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

    /**
     * @return GalleryInterface
     */
    public function getGallery();

    /**
     * @param GalleryInterface $gallery
     */
    public function setGallery($gallery);

    /**
     * @return string
     */
    public function getIsPublished();

    /**
     * @param string $isPublished
     */
    public function setIsPublished($isPublished);
}
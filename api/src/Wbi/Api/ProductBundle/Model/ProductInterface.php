<?php
/**
 * Created by PhpStorm.
 * User: majdi
 * Date: 09/11/2016
 * Time: 12:45
 */
namespace Wbi\Api\ProductBundle\Model;
use Wbi\Api\ProductBundle\Entity\date;



interface ProductInterface
{
    /**
     * @return mixed
     */
    public function getInfos();

    /**
     * @return mixed
     */
    public function getGallerys();

    public function addProductGallery(ProductGalleryInterface $gallery);

    public function setInfos(ProductInfoInterface $infos);

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
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return ProductInterface
     */
    public function setIsEnabled($isEnabled);

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
     * @return string
     */
    public function getIsPublished();

    /**
     * @param string $isPublished
     */
    public function setIsPublished($isPublished);
}
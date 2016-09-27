<?php

namespace Wbi\Api\ProductBundle\Model;


Interface ProductInterface
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
     * @return Product
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
     * @return Product
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
     * @return Product
     */
    public function setImage($image);

    /**
     * Get image
     *
     * @return string
     */
    public function getImage();
}
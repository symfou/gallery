<?php

namespace Wbi\Api\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Wbi\Api\ProductBundle\Model\ProductInterface;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="Wbi\Api\ProductBundle\Repository\ProductRepository")
 * @ExclusionPolicy("all")
 */
class Product implements ProductInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=false)
     * @Expose
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     * @Expose
     */
    protected $slug;


    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="text",  nullable=true)
     * @Expose
     */
    protected $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text",  nullable=true)
     * @Expose
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     * @Expose
     */
    protected $image;


    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=false)
     * @Expose
     */
    protected $code;
    /**
     * @ORM\Column(name="available_on", type="datetime", nullable=true)
     * @Expose
     */
    protected $availableOn;
    /**
     * @ORM\Column(name="available_until", type="datetime", nullable=true)
     * @Expose
     */
    protected $availableUntil;


    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=true)
     * @Expose
     */
    protected $price;
    /**
     * @var string
     *
     * @ORM\Column(name="vat_rate", type="decimal", precision=10, scale=2, nullable=true)
     * @Expose
     */
    protected $vatRate;
    /**
     * @var string
     *
     * @ORM\Column(name="stock", type="integer", nullable=true)
     * @Expose
     */
    protected $stock;
    /**
     * @var string
     *
     * @ORM\Column(name="is_enabled", type="boolean", nullable=false)
     * @Expose
     */
    protected $isEnabled;

    /**
     * @var string
     *
     * @ORM\Column(name="is_published", type="boolean", nullable=false)
     * @Expose
     */
    protected $isPublished;



    /**
     * @var GalleryInterface
     */
    protected $gallery;


    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     * @Expose
     */
    protected $createdAt;


    /**
     * @ORM\Column(name="updated_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     * @Expose
     */
    protected $updatedAt;


    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return (string)$this->getName();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ProductInterface
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ProductInterface
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return ProductInterface
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return date
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return date
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return ProductInterface
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     *
     * @return ProductInterface
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return ProductInterface
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set availableOn
     *
     * @param \DateTime $availableOn
     *
     * @return ProductInterface
     */
    public function setAvailableOn($availableOn)
    {
        $this->availableOn = $availableOn;

        return $this;
    }

    /**
     * Get availableOn
     *
     * @return \DateTime
     */
    public function getAvailableOn()
    {
        return $this->availableOn;
    }

    /**
     * Set availableUntil
     *
     * @param \DateTime $availableUntil
     *
     * @return ProductInterface
     */
    public function setAvailableUntil($availableUntil)
    {
        $this->availableUntil = $availableUntil;

        return $this;
    }

    /**
     * Get availableUntil
     *
     * @return \DateTime
     */
    public function getAvailableUntil()
    {
        return $this->availableUntil;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return ProductInterface
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set vatRate
     *
     * @param string $vatRate
     *
     * @return ProductInterface
     */
    public function setVatRate($vatRate)
    {
        $this->vatRate = $vatRate;

        return $this;
    }

    /**
     * Get vatRate
     *
     * @return string
     */
    public function getVatRate()
    {
        return $this->vatRate;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     *
     * @return ProductInterface
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return ProductInterface
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getIsEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ProductInterface
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return ProductInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
    /**
     * @return GalleryInterface
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param GalleryInterface $gallery
     */
    public function setGallery($gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * @return string
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * @param string $isPublished
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;
    }
}

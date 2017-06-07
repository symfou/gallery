<?php

namespace Wbi\Api\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Wbi\Api\ProductBundle\Model\ProductGalleryInterface;
use Wbi\Api\ProductBundle\Model\ProductInfoInterface;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Gedmo\Mapping\Annotation as Gedmo;
use Wbi\Api\ProductBundle\Model\ProductInterface;
use Wbi\Api\ProductBundle\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * ProductGallery
 *
 * @ORM\Table(name="product_gallery")
 * @ORM\Entity(repositoryClass="Wbi\Api\ProductBundle\Repository\ProductGalleryRepository")
 * @ExclusionPolicy("all")
 * @Gedmo\Uploadable(allowOverwrite=false, filenameGenerator="SHA1", appendNumber=true, pathMethod="getPath")
 */
class ProductGallery implements ProductGalleryInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     * @Expose
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     * @Expose
     * @Gedmo\UploadableFileMimeType
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="extention", type="string", length=255, nullable=true)
     * @Expose
     */
    private $extention;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     * @Expose
     * @Gedmo\UploadableFilePath
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="thumbnailUrl", type="string", length=255, nullable=true)
     * @Expose
     */
    private $thumbnailUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="folder", type="string", length=255, nullable=true)
     * @Expose
     */
    private $folder;


    /**
     * @var boolean
     *
     * @ORM\Column(name="is_default", type="boolean", nullable=true)
     * @Expose
     */
    private $is_default = false;

    /**
     * @return boolean
     */
    public function isIsDefault()
    {
        return $this->is_default;
    }

    /**
     * @param boolean $is_default
     */
    public function setIsDefault($is_default)
    {
        $this->is_default = $is_default;
    }


    private $path;

    /**
     * @var 
     *
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="gallerys", cascade={"persist", "merge"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * @return Region
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Region $product
     */
    public function setProduct(ProductInterface $product)
    {
        $this->product = $product;
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
     * @return ProductGallery
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
     * Set type
     *
     * @param string $type
     *
     * @return ProductGallery
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set extention
     *
     * @param string $extention
     *
     * @return ProductGallery
     */
    public function setExtention($extention)
    {
        $this->extention = $extention;

        return $this;
    }

    /**
     * Get extention
     *
     * @return string
     */
    public function getExtention()
    {
        return $this->extention;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return ProductGallery
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set thumbnailUrl
     *
     * @param string $thumbnailUrl
     *
     * @return ProductGallery
     */
    public function setThumbnailUrl($thumbnailUrl)
    {
        $this->thumbnailUrl = $thumbnailUrl;

        return $this;
    }

    /**
     * Get thumbnailUrl
     *
     * @return string
     */
    public function getThumbnailUrl()
    {
        return $this->thumbnailUrl;
    }

    /**
     * Set folder
     *
     * @param string $folder
     *
     * @return ProductGallery
     */
    public function setFolder($folder)
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * Get folder
     *
     * @return string
     */
    public function getFolder()
    {
        return $this->folder;
    }

    public function setPath($path){
        $this->path = $path;
    }

    public function getPath(/*$defaultPath*/){
        return $this->path;
    }
}


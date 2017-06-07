<?php

namespace Wbi\Api\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Wbi\Api\ProductBundle\Model\ProductGalleryInterface;
use Wbi\Api\ProductBundle\Model\ProductInterface;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Gedmo\Mapping\Annotation as Gedmo;
use Wbi\Api\ProductBundle\Entity\ProductGallery;
use Wbi\Api\ProductBundle\Model\ProductInfoInterface;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @var
     *@Expose
     * @ORM\OneToOne(targetEntity="ProductGallery", cascade={"persist", "merge"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="SET NULL")
     * })
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
     * @ORM\Column(name="is_enabled", type="boolean", nullable=true)
     * @Expose
     */
    protected $isEnabled;

    /**
     * @var string
     *
     * @ORM\Column(name="is_published", type="boolean", nullable=true)
     * @Expose
     */
    protected $isPublished;






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
     * @var
     * @ORM\OneToMany(targetEntity="ProductGallery", mappedBy="product", cascade={"persist", "remove", "merge"})
     */
    private $gallerys;

    

    /**
     * @var
     *@Expose
     * @ORM\OneToOne(targetEntity="ProductInfo", inversedBy="product", cascade={"persist", "merge"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="info_id", referencedColumnName="id")
     * })
     */
    private $infos;

    /**
     * @return mixed
     */
    public function getInfos()
    {
        return $this->infos;
    }

    /**
     * @return mixed
     */
    public function getGallerys()
    {
        return $this->gallerys;
    }



    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return (string)$this->getName();
    }

    public function __construct()
    {
        $this->gallerys = new ArrayCollection();
    }


    public function addProductGallery(ProductGalleryInterface $gallery){
        $gallery->setProduct($this);

        if (!$this->gallerys->contains($gallery)) {
            $this->gallerys->add($gallery);
        }
    }

    public function setInfos(ProductInfoInterface $infos){
        $this->infos = $infos;
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

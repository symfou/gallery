<?php

namespace Wbi\Api\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Wbi\Api\ProductBundle\Model\ProductInfoInterface;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Gedmo\Mapping\Annotation as Gedmo;
use Wbi\Api\ProductBundle\Entity\Product;
use Wbi\Api\ProductBundle\Model\ProductInterface;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Product
 *
 * @ORM\Table(name="product_info")
 * @ORM\Entity(repositoryClass="Wbi\Api\ProductBundle\Repository\ProductInfoRepository")
 * @ExclusionPolicy("all")
 */
class ProductInfo implements ProductInfoInterface
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
     * @ORM\Column(name="description", type="text",  nullable=true)
     * @Expose
     */
    protected $description;

    


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
     * @ORM\OneToOne(targetEntity="Product", mappedBy="infos", cascade={"persist", "remove", "merge"})
     */
    private $product;


    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return (string)$this->getName();
    }
    
    public function __construct()
    {
    }


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
    
}

<?php


namespace Wbi\Api\ProductBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Wbi\Api\ProductBundle\Entity\Product;
use Wbi\Api\ProductBundle\Entity\ProductGallery;
use Wbi\Api\ProductBundle\Entity\ProductInfo;
use Wbi\Api\UserBundle\Entity\User;

/**
 * Class LoadProductData
 *
 * @category
 * @author Boumaiza Majdi <boumaiza.majdi@mail.com>
 */
class LoadProductData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{


    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {

        for ($i = 1; $i <= 100 ; $i++) {

            //infos
            $productInfo = new ProductInfo();
            $productInfo
                ->setPrice(120.30)
                ->setVatRate(18.4)
                ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ')
            ;

            //gallery
            $productGallery = new ProductGallery();
            $productGallery
                ->setUrl('/image.jpg')
            ;
            
            $product = new Product();
            $product
                ->setCode('00'.$i)
                ->setName('my product '.$i)
                ->setShortDescription('Lorem ipsum dolor sit amet.')
                ->setIsEnabled(true)
                ->setSlug('my product from '.$i)
                ->setIsPublished(true)
//                ->setInfos($productInfo)
                ;
            $product->setInfos($productInfo);
            //$product->addProductGallery($productGallery);

            
            
            

            $manager->persist($product);
        }
        $manager->flush();
    }


    public function getOrder()
    {
        return 3;
    }

}
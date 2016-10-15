<?php

namespace Wbi\Api\ProductBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Wbi\Api\UserBundle\Entity\Client;
use Wbi\Api\UserBundle\Entity\User;

/**
 * Class LoadProductData
 *
 * @category
 * @author Boumaiza Majdi <boumaiza.majdi@mail.com>
 */
class LoadOauth2Data implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
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
    { }


    public function getOrder()
    {
        return 1;
    }

}
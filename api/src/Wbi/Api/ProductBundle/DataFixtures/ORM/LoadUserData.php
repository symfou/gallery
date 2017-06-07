<?php

namespace Wbi\Api\ProductBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Wbi\Api\UserBundle\Entity\User;

/**
 * Class LoadProductData
 *
 * @category
 * @author Boumaiza Majdi <boumaiza.majdi@mail.com>
 */
class LoadUserData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
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
        //generate cleint
        $this->container->get('wbi_api_user.services.oauth2generate_client')->generateClient("4lit6kyrv86cwgw8cc0c8ogwgws0oookk0o40kccww840s00wc", "30wn0vfonj0g0wgckw4okggk88w8888o0c4o8kgksw08kgww4s");

        $user = new User();
        $user->setUsername('admin')
            ->setEmail("boumaiza.majdi@gmail.com")
            ->setEmailCanonical("boumaiza.majdi@gmail.com")
            ->setRoles(array('ROLE_API', 'ROLE_ADMIN'))
            ->setEnabled(true);

        $user->setUsername('majdi')
            ->setEmail("boumaiza.majdi1@gmail.com")
            ->setEmailCanonical("boumaiza.majdi1@gmail.com")
            ->setRoles(array('ROLE_API'))
            ->setEnabled(true);

        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, 'admin');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }


    public function getOrder()
    {
        return 2;
    }

}
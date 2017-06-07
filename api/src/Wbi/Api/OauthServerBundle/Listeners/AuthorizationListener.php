<?php
/**
 * Class AuthorizationListener
 *
 * @category
 * @package Wbi\Api\OauthServerBundle\Listeners
 * @author Boumaiza Majdi <boumaiza.majdi@mail.com>
 */


namespace Wbi\Api\OauthServerBundle\Listeners;


class AuthorizationListener
{
    private $authorizedClients;

    /**
     * AuthorizationListener constructor.
     * @param $authorizedClients
     */
    public function __construct(array $authorizedClients)
    {
        $this->authorizedClients = $authorizedClients;
    }

    public function preAutorization($event){
//        dump($event->getClient()->getRandomId());die();
        if (in_array($event->getClient()->getRandomId(), $this->authorizedClients)){
            $event->setAuthorizedClient(true);
        }
    }
}
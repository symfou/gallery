<?php

namespace Wbi\Api\UserBundle\Services;

/**
 * Class Oauth2GenerateClient
 *
 * @category
 * @author Boumaiza Majdi <boumaiza.majdi@mail.com>
 */
class Oauth2GenerateClient
{

    private $name, $redirectUri, $grantTypes, $fosOauthServer;

    /**
     * Oauth2GenerateClient constructor.
     * @param $redirectUri
     * @param $name
     * @param $grantTypes
     * @param $client_manager
     */
    public function __construct($redirectUri, $name, $grantTypes, $client_manager)
    {
        $this->redirectUri = $redirectUri;
        $this->name = $name;
        $this->grantTypes = $grantTypes;
        $this->client_manager = $client_manager;
    }


    public function generateClient($clientId = null, $secret = null){
        $client = $this->client_manager->createClient();
//        $client->setName($this->name);
        $client->setRedirectUris(array('URL' => $this->redirectUri));
        $client->setAllowedGrantTypes($this->grantTypes);
        if ($clientId){
            $client->setRandomId($clientId);
        }
        if ($secret){
            $client->setSecret($secret);
        }
        $this->client_manager->updateClient($client);
        echo "id_client: ".$client->getId();
    }
}
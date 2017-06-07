<?php
/**
 * Class StoreAuthenticator
 *
 * @category
 * @package Wbi\Api\ProductBundle\Security
 * @author Boumaiza Majdi <boumaiza.majdi@mail.com>
 */


namespace Wbi\Api\ProductBundle\Security;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use GuzzleHttp\Client;
use OAuth2\OAuth2;

class StoreAuthenticator extends AbstractGuardAuthenticator
{

    private $oauthServer;
    private $userManager;

    /**
     * StoreAuthenticator constructor.
     * @param $userManager
     * @param $oauthServer
     */
    public function __construct($oauthServer, $userManager)
    {
        $this->userManager = $userManager;
        $this->oauthServer = $oauthServer;
    }


    /**
     * Called on every request. Return whatever credentials you want,
     * or null to stop authentication.
     */
    public function getCredentials(Request $request)
    {
        $accessToken = $this->oauthServer->getBearerToken($request);
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://51.255.41.5:8085/auth/',
            // You can set any number of default request options.
            'timeout'  => 10,
        ]);

       $response = $client->request('GET', 'api/v1/user/profile', [
           'headers' => [
               'Accept' => 'application/json, text/plain, */*',
               'Accept-Encoding'     => 'gzip, deflate, sdch',
               'Accept-Language'      => 'fr-FR,fr;q=0.8,en-US;q=0.6,en;q=0.4',
               'Authorization' => 'Bearer '.$accessToken,
           ]
       ]);
        if ($response->getStatusCode()){
            $body = json_decode($response->getBody(), true);
        }
        return ["user" => $body];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        try{
            $user = $userProvider->loadUserByUsername($credentials['user']['username']);
        }catch (UsernameNotFoundException $e){
            $user = $this->userManager->createUser()
                ->setUserName($credentials['user']['username'])
                ->setEmail($credentials['user']['email'])
                ->setEmailCanonical($credentials['user']['email_canonical'])
                ->setEnabled($credentials['user']['enabled'])
//                ->setSalt($credentials['user']['salt'])
                ->setPassword($credentials['user']['password'])
                ->setLastLogin(new \DateTime($credentials['user']['last_login']) )
                ->setLocked($credentials['user']['locked'])
                ->setRoles($credentials['user']['roles'])
            ;
            $this->userManager->updateUser($user);
        }

        // if null, authentication will fail
        // if a User object, checkCredentials() is called
        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        // check credentials - e.g. make sure the password is valid
        // no credential check is needed in this case

        // return true to cause authentication success
        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // on success, let the request continue
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = array(
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())

            // or to translate this message
            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        );

        return new JsonResponse($data, 403);
    }

    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = array(
            // you might translate this message
            'message' => 'Authentication Required'
        );

        return new JsonResponse($data, 401);
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
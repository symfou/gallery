<?php

namespace Wbi\Api\OauthServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WbiApiOauthServerBundle:Default:index.html.twig');
    }
}

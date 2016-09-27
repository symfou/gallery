<?php

namespace Wbi\Api\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\RestBundle\Controller\FOSRestController;

class UserController extends FOSRestController
{
	
  
    public function getTestAction()
    {
        $data = array("hello" => "world");
        $view = $this->view($data);
        return $this->handleView($view);
    }
	
	
	public function getProfileAction()
    {
        $request = $this->getRequest();
		$em = $this->getDoctrine()->getManager();
		$user = $this->getUser();
		$profile = $user->getProfile();
		
		$view = $this->view($profile, 200);
		$view->setTemplateVar('profile');
        return $this->handleView($view);
    }
}

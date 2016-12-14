<?php

namespace Swd\SecuredBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
	public function listAction(Request $request)
	{
		$authenticationUtils = $this->get('security.authentication_utils');

		// get the login error if there is one
		$error = $authenticationUtils->getLastAuthenticationError();

		// last username entered by the user
		$lastUsername = $authenticationUtils->getLastUsername();

		return $this->render('SecuredBundle:Admin:list.html.twig', array(
			'last_username' => $lastUsername,
			'error' => $error,
		));
	}
}

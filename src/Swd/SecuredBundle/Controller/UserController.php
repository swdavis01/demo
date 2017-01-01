<?php

namespace Swd\SecuredBundle\Controller;

use Swd\CoreBundle\Response\ApiResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpFoundation\JsonResponse;
//use Symfony\Component\Serializer\Encoder\JsonEncoder;
//use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
//use Symfony\Component\Serializer\Serializer;

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

	public function getListAction(Request $request)
	{
		/*$result = $this->get( 'swd_core_user_service' )->getUsers();

		$serializer = new Serializer(array(new GetSetMethodNormalizer()), array(new JsonEncoder()));

		return new Response( $request->query->get('callback') . "(" . $serializer->serialize($result, 'json') . ")" );*/

		return ApiResponse::Response( $request, $this->get( 'swd_core_user_service' )->getUsers() );
	}
}

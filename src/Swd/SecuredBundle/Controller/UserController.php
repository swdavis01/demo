<?php

namespace Swd\SecuredBundle\Controller;

use Swd\CoreBundle\Response\ApiResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swd\CoreBundle\Services\DateService;

class UserController extends Controller
{
	public function listAction(Request $request)
	{
		return $this->render('SecuredBundle:Admin:list.html.twig', array(
			'dateTimeFormat' => DateService::DATE_TIME_UI
		));
	}

	public function getListAction(Request $request)
	{
		return ApiResponse::Response( $request, $this->get( 'swd_core_user_service' )->getUsers() );
	}

	public function formAction($id)
	{
		return $this->render('SecuredBundle:Admin:form.html.twig', array(
			'id' => $id
		));
	}

}

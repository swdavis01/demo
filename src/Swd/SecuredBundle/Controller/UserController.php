<?php

namespace Swd\SecuredBundle\Controller;

use Swd\CoreBundle\Response\ApiResponse;
use Swd\CoreBundle\Services\CommonService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swd\CoreBundle\Services\DateService;
use Swd\SecuredBundle\Voters\UserVoter;
use Swd\SecuredBundle\Forms\UserType;
use Swd\CoreBundle\Entity\User;

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
		$this->denyAccessUnlessGranted(UserVoter::VIEW);
		return ApiResponse::Response( $request, $this->get( 'swd_core_user_service' )->getUsers() );
	}

	public function formAction($id, Request $request)
	{
		$this->denyAccessUnlessGranted(UserVoter::EDIT);

		if ( $id > 0 )
		{
			$user = $this->get( 'swd_core_user_service' )->getUserById( $id );
			if ( !is_object( $user ) )
			{
				throw new UsernameNotFoundException( "Unable to find user " . $id, 0 );
			}
		}
		else
		{
			$user = new User();
		}
		$form = $this->createForm(UserType::class, $user);
		//var_dump($user->getUserRoles()); exit;

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid())
		{
			$this->get( 'swd_core_user_service' )->save( $form->getData() );
		}

		return $this->render('SecuredBundle:Admin:form.html.twig', array(
			'form' => $form->createView(),
			'id' => $id,
			'userRoles' => $user->getUserRoles(),
			'readonly' => ( $id > 0 ) ? true : false
		));
	}

}

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
		//echo "";
		//CommonService::print_r($this->get( 'swd_core_user_service' )->getUserList()); exit;
		return $this->render('SecuredBundle:Admin:list.html.twig', array(
			'dateTimeFormat' => DateService::DATE_TIME_UI
		));
	}

	public function getListAction(Request $request)
	{
		$this->denyAccessUnlessGranted(UserVoter::VIEW);

		$params = array( 'search' => '' );
		$data = json_decode( $request->request->get('request') );
		if ( is_object( $data ) )
		{
			if ( isset( $data->search ) )
			{
				$params['search'] = isset( $data->search[0]) ? $data->search[0]->value : null;
			}

			if ( isset( $data->sort ) )
			{
				//CommonService::print_r($data->sort);
				$params['orderBy'] = isset( $data->sort[0]) ? $data->sort[0]->field : null;
				$params['sortBy'] = isset( $data->sort[0]) ? $data->sort[0]->direction : null;
				//return ApiResponse::Response( $request, $data );
				//$params['orderBy'] = $data->sort->field;
				//$params['sortBy'] = $data->sort->direction;
			}

			if ( $data->cmd === "delete" && isset( $data->selected ) )
			{
				$this->get( 'swd_core_user_service' )->deleteUsers( $data->selected );
			}
		}

		return ApiResponse::Response( $request, $this->get( 'swd_core_user_service' )->getUsers( $params ) );
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
			$u = $form->getData();
			$u->setUserRoleIds( $request->request->get('userRoles') );
			$this->get( 'swd_core_user_service' )->save( $u );
		}

		//CommonService::print_r($this->get( 'swd_core_user_service' )->getRoleList( $id )); exit;

		return $this->render('SecuredBundle:Admin:form.html.twig', array(
			'form' => $form->createView(),
			'id' => $id,
			'roles' => $this->get( 'swd_core_user_service' )->getRoleList( $id ),
			'readonly' => ( $id > 0 ) ? true : false
		));
	}

}

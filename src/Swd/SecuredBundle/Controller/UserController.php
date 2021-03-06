<?php

namespace Swd\SecuredBundle\Controller;

use Swd\CoreBundle\Response\ApiResponse;
use Swd\CoreBundle\Services\CommonService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swd\CoreBundle\Services\DateService;
use Swd\SecuredBundle\Voters\UserVoter;
use Swd\SecuredBundle\Forms\UserType;
use Swd\CoreBundle\Object\User;
use Aws\S3\S3Client;

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

		$records = $this->get( 'swd_core_user_service' )->getUsers( $params );
		return ApiResponse::Response( $request, $records );
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

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid())
		{
			$u = $form->getData();
			$u->setUserRoleIds( $request->request->get('userRoles') );
			$id = $this->get( 'swd_core_user_service' )->save( $u );

			// set on tab
			$this->get( 'swd_core_user_service' )->getSession()->set( 'userTabsOn', $request->request->get( 'userTabsOn' ) );

			$command = $request->request->get('userSave');
			if ( $command == "saveClose" )
			{
				return $this->redirect( $this->generateUrl( 'swd_admin_user_list' ) );
			}
			return $this->redirect( $this->generateUrl( 'swd_admin_user', array( 'id' => $id ) ) );
		}

		return $this->render('SecuredBundle:Admin:form.html.twig', array(
			'form' => $form->createView(),
			'id' => $id,
			'roles' => $this->get( 'swd_core_user_service' )->getRoleList( $id ),
			'readonly' => ( $id > 0 ) ? true : false,
			'userTabsOn' => $this->get( 'swd_core_user_service' )->getSession()->get( 'userTabsOn' )
		));
	}

}

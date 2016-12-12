<?php

namespace Swd\CoreBundle\Services;

use Swd\CoreBundle\Entity\User;

class UserService extends BaseService
{
	/**
	 * UserService constructor.
	 * @param \Doctrine\ORM\EntityManager $em
	 */
	public function __construct( \Doctrine\ORM\EntityManager $em )
	{
		parent::__construct( $em );
	}

	/**
	 * @param $username
	 * @return User
	 */
	public function getUserByUsername( $username )
	{
		$user = $this->em->getRepository('CoreBundle:User')->findOneByUsername( $username );
		//CommonService::debug( $user ); exit;
		if ( is_object( $user ) )
		{
			$user = $this->setRoles( $user );
			return $user;
		}
	}

	/**
	 * @param $id
	 * @return User
	 */
	public function getUserById( $id )
	{
		$user = $this->em->getRepository( 'CoreBundle:User' )->findOneById( $id );
		if ( is_object( $user ) )
		{
			$user = $this->setRoles( $user );
			return $user;
		}
	}

	/**
	 * @param User $user
	 * @return User
	 */
	private function setRoles( User $user )
	{
		if ( is_object( $user ) )
		{
			$roles = $this->em->getRepository( 'CoreBundle:UserRole' )->findByUserId( $user->getId() );
			if ( is_array( $roles ) )
			{
				$userRoles = array();
				foreach( $roles as $role )
				{
					$userRoles[] = $role->getRole();
				}
				$user->setRoles( $userRoles );
			}
		}

		return $user;
	}
}
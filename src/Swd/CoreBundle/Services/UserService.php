<?php

namespace Swd\CoreBundle\Services;

use Swd\CoreBundle\Entity\User;
use Swd\CoreBundle\Services\CommonService;

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
		$query = $this->em->createQuery(
			'SELECT 
				u
    		FROM 
    			CoreBundle:User u
    			JOIN u.roles r 	
    		WHERE 
    			u.username = :username'
		)->setParameter('username', $username);

		//CommonService::debug( $username ); exit;

		try {
			$user = $query->getSingleResult();
		} catch ( \Doctrine\ORM\ORMException $e ) {
			var_dump($e); exit;
		}

		CommonService::debug( $user ); exit;
		return $user;

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
			/*$roles = $this->em->getRepository( 'CoreBundle:UserRole' )->findByUserId( $user->getId() );
			if ( is_array( $roles ) )
			{
				$userRoles = array();
				foreach( $roles as $role )
				{
					$userRoles[] = $role->getRole();
				}
				$user->setRoles( $userRoles );
			}*/

			$query = $this->em->createQuery(
				'SELECT 
				ur, r
    		FROM 
    			CoreBundle:UserRole ur
    			JOIN CoreBundle:Role r 
    		WHERE 
    			ur.userId = :user_id
    		ORDER BY 
    			r.role 
    		ASC'
			)->setParameter('user_id', $user->getId());

			try {
				$roles = $query->getResult();
			} catch ( \Doctrine\ORM\ORMException $e ) {
				CommonService::debug($e); exit;
			}
			//CommonService::debug('getRoles'); exit;
			CommonService::debug($roles); exit;

			$user->setRoles( $roles );
		}

		return $user;
	}

	/**
	 * @param $id
	 * @return User
	 */
	public function getUsers( $params = array() )
	{
		$page = 1;
		$username = "asfsaf";

		extract( $params );

		//$result = $this->em->getRepository( 'CoreBundle:User' )->findAll();
		//print_r($users); exit;

		$query = $this->em->createQuery(
			'SELECT 
				u
    		FROM 
    			CoreBundle:User u
    			JOIN CoreBundle:Role r 
    		WHERE 
    			u.username != :username
    		ORDER BY 
    			u.username 
    		ASC'
		)->setParameter('username', $username);

		$result = $query->getResult();

		return $result;
	}
}

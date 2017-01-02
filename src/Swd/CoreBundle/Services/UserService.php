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
				u, r
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

		//CommonService::debug( $user ); exit;
		return $user;
	}

	/**
	 * @param $id
	 * @return User
	 */
	public function getUserById( $id )
	{
		$query = $this->em->createQuery(
			'SELECT 
				u, r
    		FROM 
    			CoreBundle:User u
    			JOIN u.roles r 	
    		WHERE 
    			u.id = :id'
		)->setParameter('id', $id);

		//CommonService::debug( $id ); exit;

		try {
			$user = $query->getSingleResult();
		} catch ( \Doctrine\ORM\ORMException $e ) {
			var_dump($e); exit;
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

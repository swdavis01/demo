<?php

namespace Swd\CoreBundle\Services;

use Swd\CoreBundle\Entity\User;
use Swd\CoreBundle\Entity\UserRole;
use Swd\CoreBundle\Services\CommonService;
use Swd\CoreBundle\Database\Database;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class RoleService extends BaseService
{
	/**
	 * RoleService constructor.
	 * @param \Doctrine\ORM\EntityManager $em
	 */
	public function __construct( \Doctrine\ORM\EntityManager $em, Database $db )
	{
		parent::__construct( $em, $db );
	}

	/**
	 * @param $params array
	 * @return array
	 */
	public function getRoles( $params = array() )
	{
		$name = "";

		extract( $params );

		//$result = $this->em->getRepository( 'CoreBundle:Role' )->findAll();
		//print_r($users); exit;

		$query = $this->em->createQuery(
			'SELECT 
				r
    		FROM 
    			CoreBundle:Role r
    		ORDER BY 
    			r.section ASC, r.priority ASC'
		);

		$result = $query->getResult();

		return $result;
	}

	/**
	 * @param $params array
	 * @return array
	 */
	public function getUserRoles( $user_id, $params = array() )
	{
		$name = "";

		extract( $params );

		//$result = $this->em->getRepository( 'CoreBundle:Role' )->findAll();
		//print_r($users); exit;

		$query = $this->em->createQuery(
			'SELECT 
				r
    		FROM 
    			CoreBundle:Role r
    		ORDER BY 
    			r.section ASC, r.priority ASC'
		);

		$result = $query->getResult();

		$userRoles = array();
		foreach( $result as $role )
		{
			$userRole = new UserRole();
			$userRole->setUserId( $user_id );
			$userRole->setRoleId( $role->getId() );
			$userRole->setRole( $role );

			$userRoles[] = $userRole;
		}

		return $userRoles;
	}

	/**
	 * @param $params array
	 * @return array
	 */
	public function getUserRolesByUserId( $user_id, $params = array() )
	{
		extract( $params );

		/*$query = $this->em->createQuery(
			'SELECT 
				r
    		FROM 
    			CoreBundle:Role r
    		ORDER BY 
    			r.section ASC, r.priority ASC'
		);*/

		$query = $this->em->createQuery(
			'SELECT 
				ur
    		FROM 
    			CoreBundle:UserRole ur 	
    		WHERE 
    			ur.userId = :user_id'
		)->setParameter('user_id', $user_id);

		$result = $query->getResult();

		$userRoles = array();

		if ( count( $result ) > 0 )
		{
			$roles = $this->getUserRoles( $user_id );
			foreach( $result as $ur )
			{
				$userRole = new UserRole();
				foreach($roles as $role)
				{
					if ( $role->getRoleId() == $ur->getRoleId() )
					{
						$userRole->setUserId( $user_id );
						$userRole->setRoleId( $ur->getRoleId() );
						$userRole->setRole( $ur->getRole() );
						$userRoles[] = $userRole;
					}
				}
			}
		}

		//var_dump($userRoles); exit;

		return $userRoles;
	}
}

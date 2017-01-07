<?php

namespace Swd\CoreBundle\Services;

use Swd\CoreBundle\Entity\User;
use Swd\CoreBundle\Entity\UserRole;
use Swd\CoreBundle\Services\CommonService;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class RoleService extends BaseService
{
	/**
	 * RoleService constructor.
	 * @param \Doctrine\ORM\EntityManager $em
	 */
	public function __construct( \Doctrine\ORM\EntityManager $em )
	{
		parent::__construct( $em );
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
}

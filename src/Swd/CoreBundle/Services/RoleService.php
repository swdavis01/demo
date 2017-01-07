<?php

namespace Swd\CoreBundle\Services;

use Swd\CoreBundle\Entity\User;
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
    			r.id 
    		ASC'
		);

		$result = $query->getResult();

		return $result;
	}
}

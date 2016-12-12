<?php

namespace Swd\CoreBundle\Services;

class BaseService
{
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $em;

	public function __construct( \Doctrine\ORM\EntityManager $em )
	{
		$this->em = $em;
	}
}

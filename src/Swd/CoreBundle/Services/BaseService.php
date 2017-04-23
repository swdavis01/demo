<?php

namespace Swd\CoreBundle\Services;

use Swd\CoreBundle\Database\Database;
use Symfony\Component\HttpFoundation\Session\Session;

class BaseService
{
	/**
	 * @var Swd\CoreBundle\Database\Database
	 */
	protected $db;

	/**
	 * @var Session
	 */
	protected $session;

	public function __construct( Database $db )
	{
		$this->db = $db;
		$this->session = new Session();
		$this->session->start();
	}

	public function self()
	{
		return $this;
	}

	/**
	 * @return Session
	 */
	public function getSession()
	{
		return $this->session;
	}

	/**
	 * @param $alias
	 * @param $params
	 * @return array
	 */
	public function parseParams( $alias, $params )
	{
		if ( isset( $params['orderBy'] ) )
		{
			if ( $params['orderBy'] === "createdDateTimeFormat" )
			{
				$params['orderBy'] = $alias . "created";
			}

			if ( $params['orderBy'] === "updatedDateTimeFormat" )
			{
				$params['orderBy'] = $alias . "updated";
			}
		}

		return $params;
	}
}

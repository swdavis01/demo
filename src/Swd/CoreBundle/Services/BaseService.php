<?php

namespace Swd\CoreBundle\Services;

use Swd\CoreBundle\Database\Database;
use Swd\CoreBundle\Services\AssetService;
use Symfony\Component\HttpFoundation\Session\Session;

class BaseService
{
	/**
	 * @var \Swd\CoreBundle\Database\Database
	 */
	protected $db;

	/**
	 * @var Session
	 */
	protected $session;

	/**
	 * @var \Swd\CoreBundle\Services\AssetService
	 */
	protected $assetService;

	/**
	 * BaseService constructor.
	 * @param Database $db
	 * @param \Swd\CoreBundle\Services\AssetService $assetService
	 */
	public function __construct( Database $db, AssetService $assetService )
	{
		$this->db = $db;
		$this->assetService = $assetService;
		$this->session = new Session();
		//$this->session->start();
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

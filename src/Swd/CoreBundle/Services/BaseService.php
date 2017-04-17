<?php

namespace Swd\CoreBundle\Services;

use Swd\CoreBundle\Database\Database;

class BaseService
{
	/**
	 * @var Swd\CoreBundle\Database\Database
	 */
	protected $db;

	public function __construct( Database $db )
	{
		$this->db = $db;
	}

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

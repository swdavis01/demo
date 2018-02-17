<?php

namespace Swd\CoreBundle\Services;

use Swd\CoreBundle\Services\CommonService;
use Swd\CoreBundle\Database\Database;

class EntityService extends BaseService
{
	public function __construct( Database $db, \Swd\CoreBundle\Services\AssetService $assetService )
	{
		parent::__construct( $db, $assetService );
	}

	/**
	 * @param $params array
	 * @return array
	 */
	public function createBaseEntities( $params = array() )
	{
	    $tables = $this->getTablesWithFields();
	    foreach( $tables as $table)
        {
            $this->logDebug( $table, __CLASS__, __FUNCTION__ );
        }
	}
}

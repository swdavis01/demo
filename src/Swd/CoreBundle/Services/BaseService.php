<?php

namespace Swd\CoreBundle\Services;

use Swd\CoreBundle\Database\Database;
use Swd\CoreBundle\Services\AssetService;
use Swd\CoreBundle\Util\ConsoleLogger;
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

	private $logger;

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

    /**
     * @return array
     */
    protected function getTablesWithFields()
    {
        $values = array();
        foreach( $this->getTables() as $table)
        {
            $row = array
            (
                'table' => $table,
                'fields' => $this->getTableFields( $table )
            );
            $values[] = $row;
        }
        return $values;
    }

    /**
     * @return array
     */
    protected function getTables()
    {
        $values = array();

        $sql = "SHOW TABLES";
        $result = $this->db->fetchAll( $sql );
        foreach( $result as $row )
        {
            $values[] = array_pop( $row );
        }

        return $values;
    }

    /**
     * @param $table
     * @return array
     */
    protected function getTableFields( $table )
    {
        $values = array();

        $sql = "SHOW FIELDS FROM " . $table;
        $result = $this->db->fetchAll( $sql );
        foreach( $result as $row )
        {
            $values[] = $row;
        }

        return $values;
    }

    public function setLogger( $logger )
    {
        $this->logger = $logger;
    }

    /**
     * @param $message
     * @param $class
     * @param $function
     */
    protected function logDebug( $message, $class, $function )
    {
        $this->log( $message, $class, $function, "debug" );
    }

    /**
     * @param $message
     * @param $class
     * @param $function
     */
    protected function logInfo( $message, $class, $function )
    {
        $this->log( $message, $class, $function, "debug" );
    }

    /**
     * @param $message
     * @param $class
     * @param $function
     */
    protected function logWarning( $message, $class, $function )
    {
        $this->log( $message, $class, $function, "debug" );
    }

    /**
     * @param $message
     * @param $class
     * @param $function
     */
    protected function logError( $message, $class, $function )
    {
        $this->log( $message, $class, $function, "debug" );
    }

    /**
     * @param $message
     * @param $class
     * @param $function
     * @param $mode
     */
    private function log( $message, $class, $function, $mode )
    {
        if (  $this->logger instanceof ConsoleLogger )
        {
            if ( is_array( $message ) || is_object( $message) )
            {
                ob_start();
                    print_r( $message );
                    $message = ob_get_contents();
                ob_end_clean();
            }
            $message .= ", " . $class . "->" . $function . "()";
            switch( $mode )
            {
                case "debug":
                    $this->logger->debug( $message );
                break;

                case "info":
                    $this->logger->info( $message );
                break;

                case "warning":
                    $this->logger->warning( $message );
                break;

                case "error":
                    $this->logger->error( $message );
                break;

            }
        }
    }
}

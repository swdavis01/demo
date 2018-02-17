<?php
namespace Swd\CoreBundle\Database;

use Swd\CoreBundle\Services\CommonService;
use \PDO;

class Database
{
	private $connection = null;

	public function __construct($host, $name, $user, $pass)
	{
		try
		{
			$this->connection = new PDO("mysql:host=$host;dbname=$name", $user, $pass);
		}
		catch (PDOException $e)
		{
			die($e->getMessage());
		}
		$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}

	private function prepare($sql)
	{
		try
		{
			$st = $this->connection->prepare($sql);
		}
		catch (PDOException $ex)
		{
			CommonService::debug($ex->getMessage());
			exit;
		}
		//CommonService::debug($st);
		return $st;
	}

	public function execute( $sql, $placeholders )
	{
		$st = $this->prepare( $sql );
		try
		{
			$st->execute( $placeholders );
		}
		catch ( PDOException $ex )
		{
			CommonService::debug( $ex->getMessage() );
			exit;
		}
		return $st;
	}

	public function fetchAll($sql, $params = array())
	{
	    //$fetchType = PDO::FETCH_ASSOC;

	    extract( $params );

		$st = $this->execute($sql, $params);

		try
		{
            $results = $st->fetchAll( PDO::FETCH_ASSOC );
		}
		catch (PDOException $ex)
		{
			CommonService::debug($ex->getMessage());
			exit;
		}

		return $results;
	}

	public function fetchOne($sql, $params)
	{
		$results = $this->fetchAll($sql, $params);
		foreach ( $results as $row )
		{
			return $row;
		}

		return null;
	}

	public function lastInsertId()
	{
		return $this->connection->lastInsertId();
	}

}
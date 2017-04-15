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
		//SELECT u.*, r.* FROM user u INNER JOIN user_rolesz ur ON (u.user_id = ur.user_id) INNER JOIN roles r ON (r.role_id = ur.role_id) WHERE u.id = 1
		//CommonService::debug($sql);
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

	public function execute($sql, $params)
	{
		$st = $this->prepare($sql);
		try
		{
			$st->execute($params);
		}
		catch (PDOException $ex)
		{
			CommonService::debug($ex->getMessage());
			exit;
		}
		return $st;
	}

	public function fetchAll($sql, $params)
	{
		$st = $this->execute($sql, $params);

		try
		{
			$results = $st->fetchAll(PDO::FETCH_ASSOC);
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
}
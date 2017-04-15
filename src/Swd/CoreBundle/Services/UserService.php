<?php

namespace Swd\CoreBundle\Services;

use Swd\CoreBundle\Entity\Role;
use Swd\CoreBundle\Entity\User;
use Swd\CoreBundle\Entity\UserRole;
use Swd\CoreBundle\Services\CommonService;
use Swd\CoreBundle\Database\Database;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserService extends BaseService
{
	/**
	 * @var EncoderFactoryInterface
	 */
	private $encoderFactory;

	/**
	 * UserService constructor.
	 * @param \Doctrine\ORM\EntityManager $em
	 */
	public function __construct( \Doctrine\ORM\EntityManager $em, EncoderFactoryInterface $encoderFactory, Database $db )
	{
		parent::__construct( $em, $db );
		$this->encoderFactory = $encoderFactory;
	}

	/**
	 * @param $username
	 * @return User
	 */
	public function getUserByUsername( $username )
	{
		$params = array
		(
			'placeholders' => array( ':username' => $username ),
			'where' => 'u.username = :username'
		);

		$result = $this->get( $params );
		if ( count( $result ) > 0 )
		{
			return $result[0];
		}

		return null;
	}

	/**
	 * @param $id
	 * @return User
	 */
	public function getUserById( $id )
	{
		$params = array
		(
			'placeholders' => array( ':id' => $id ),
			'where' => 'u.id = :id'
		);

		$result = $this->get( $params );
		if ( count( $result ) > 0 )
		{
			return $result[0];
		}

		return null;
	}

	/**
	 * @param $params array
	 * @return array
	 */
	public function getUsers( $params = array() )
	{
		$page = 1;
		$username = "";

		extract( $params );

		$result = $this->get( $params );

		return $result;
	}

	private function get( $params = array() )
	{
		$where = "1 = 1";
		$placeholders = array();
		$orderBy = "u.name";
		$sortBy = "ASC";

		extract( $params );

		//CommonService::print_r($params);

		$values = array();

		$sql = "SELECT 
				u.*,
				r.id AS role_id,
				r.name AS rowName,
				r.section AS rowSection,
				r.priority AS rowPriority
    		FROM 
    			user u
    			LEFT JOIN user_role ur ON (u.id = ur.user_id)
    			LEFT JOIN role r ON (r.id = ur.role_id)
    		WHERE 
    			" . $where . " 
    		ORDER BY 
    			" . $orderBy . " " . $sortBy;
		$result = $this->db->fetchAll( $sql, $placeholders );
		foreach( $result as $row )
		{
			$id = $row['id'];

			if ( isset( $values[ $id ] ) )
			{
				$user = $values[ $id ];
			}
			else
			{
				$user = new User();
				$user->setId( $row['id'] );
				$user->setUsername( $row['username'] );
				$user->setName( $row['name'] );
				$user->setPassword( $row['password'] );
				$user->setCreated( $row['created'] );
				$user->setUpdated( $row['updated'] );
			}

			$role = new Role();
			$role->setName( $row['rowName'] );
			$role->setSection( $row['rowSection'] );
			$role->setPriority( $row['rowPriority'] );

			$userRole = new UserRole();
			$userRole->setRoleId( $row['role_id'] );
			$userRole->setUserId( $row['id'] );
			$userRole->setRole( $role );

			$user->addUserRole( $userRole );

			$values[$id] = $user;
		}

		return array_values( $values );
	}

	private function deleteRoles( $user_id )
	{
		$sql =
			'DELETE 
    		FROM 
    			user_role
    		WHERE 
    			user_id = :user_id';
		$this->db->execute( $sql, array( ':user_id' => $user_id ) );
	}

	private function saveRole( $user_id, $role_id )
	{
		$sql =
			'INSERT INTO 
    			user_role
    		SET 
    			user_id = :user_id, 
    			role_id = :role_id';
		$this->db->execute( $sql, array( ':user_id' => $user_id, ':role_id' => $role_id ) );
	}

	public function save( User $user )
	{
		$sql = "
			is_active = :is_active,
			name = :name,
			username = :username, 
			updated = :updated
		";

		$placeholders = array
		(
			':is_active' => $user->getIsActive(),
			':name' => $user->getName(),
			':username' => $user->getUsername(),
			':updated' => DateService::getCurrentDateTimeString()
		);

		if (strlen( $user->getPassword() ) > 0 )
		{
			$encoder = $this->encoderFactory->getEncoder($user);
			$encoded = $encoder->encodePassword( $user->getPassword(), "" );
			$user->setPassword($encoded);

			$sql .= ",
			password = :password";

			$placeholders[':password'] = $user->getPassword();
		}

		$this->deleteRoles( $user->getId() );

		if ( $user->getId() > 0 )
		{
			$sql = " UPDATE user SET " . $sql . " WHERE id = :id";
			$placeholders[':id'] = $user->getId();
			$this->db->execute( $sql, $placeholders );
		}
		else
		{
			$placeholders[':created'] = DateService::getCurrentDateTimeString();
			$sql = "INSERT INTO user SET " . $sql;
			$this->db->execute( $sql, $placeholders );
			$user->setId( $this->db->lastInsertId() );
		}

		foreach( $user->getUserRoles() as $userRole )
		{
			$this->saveRole( $user->getId(), $userRole->getRoleId() );
		}
	}
}

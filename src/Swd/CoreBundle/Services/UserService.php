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
	 * @param Database $db
	 * @param EncoderFactoryInterface $encoderFactory
	 */
	public function __construct( Database $db, \Swd\CoreBundle\Services\AssetService $assetService, EncoderFactoryInterface $encoderFactory )
	{
		parent::__construct( $db, $assetService );
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
		$result = $this->get( $params );

		return $result;
	}

	/**
	 * @param $params array
	 * @return array
	 */
	public function getUserList( $params = array() )
	{
		$values = array();
		$result = $this->get( $params );

		foreach($result as $user)
		{
			$u = array
			(
				'id' => $user->getId(),
				'name' => $user->getName(),
				'username' => $user->getUsername(),
				'rolesString' => $user->getRolesString(),
				'createdDateTimeFormat' => $user->getCreatedDateTimeFormat(),
				'updatedDateTimeFormat' => $user->getUpdatedDateTimeFormat()
			);

			$values[] = $u;
		}

		return $values;
	}

	private function get( $params = array() )
	{
		$where = "1";
		$placeholders = array();
		$orderBy = "u.name";
		$sortBy = "ASC";
		$search = "";
		$isActive = 1;

		extract( $this->parseParams( "u.", $params ) );

		$placeholders[':isActive'] = $isActive;

		if ( strlen( $search ) > 0 )
		{
			$where .= " AND (u.name LIKE :search1 OR u.username LIKE :search2)";
			$placeholders[':search1'] = "" . $search . "%";
			$placeholders[':search2'] = "" . $search . "%";
		}

		if ( strlen( $where ) > 0 )
		{
			$where = " AND " . $where;
		}

		//CommonService::print_r($params);

		$values = array();

		$sql = "SELECT 
				u.*,
				u.id AS recid,
				r.id AS role_id,
				r.name AS rowName,
				r.section AS rowSection,
				r.priority AS rowPriority,
				a.url AS profileImageUrl,
				a.path AS profileImagePath,
				a.name AS profileImageName
    		FROM 
    			user u
    			LEFT JOIN user_role ur ON (u.id = ur.user_id)
    			LEFT JOIN role r ON (r.id = ur.role_id)
    			LEFT JOIN asset a ON (u.assetId = a.id)
    		WHERE 
    			u.isActive = :isActive " . $where . " 
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
				$user->setProfileImageUrl( $row['profileImageUrl'] );
				//$user->setProfileImageData( $this->assetService->getObject( $row['profileImagePath'], $row['profileImageName'] ) );
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

	/**
	 * @param User $user
	 * @return int
	 */
	public function save( User $user )
	{
		$sql = "
			isActive = :isActive,
			name = :name,
			username = :username, 
			updated = :updated
		";

		$placeholders = array
		(
			':isActive' => $user->getIsActive(),
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

		// upload profile image
		if ( is_object( $user->getAsset() ) )
		{
			$assetId = $this->assetService->uploadFile( $user->getAsset(), "admin/user/profiles" );
			$sql .= ", assetId = :assetId";
			$placeholders[':assetId'] = $assetId;
		}

		if ( $user->getId() > 0 )
		{
			$sql = " UPDATE user SET " . $sql . " WHERE id = :id";
			$placeholders[':id'] = $user->getId();
			$this->db->execute( $sql, $placeholders );
		}
		else
		{
			$placeholders[':created'] = DateService::getCurrentDateTimeString();
			$sql = "INSERT INTO user SET " . $sql . ", created = :created";
			$this->db->execute( $sql, $placeholders );
			$user->setId( $this->db->lastInsertId() );
		}

		if ( count( $user->getUserRoleIds() ) > 0 )
		{
			$this->deleteRoles( $user->getId() );
			foreach( $user->getUserRoleIds() as $roleId )
			{
				$this->saveRole( $user->getId(), $roleId );
			}
		}

		return $user->getId();
	}

	/**
	 * @param array $idArray
	 */
	public function deleteUsers( $idArray = array() )
	{
		if ( count( $idArray ) > 0 )
		{
			foreach( $idArray as $id )
			{
				$this->deleteUser( $id );
			}
		}
	}

	/**
	 * @param $id
	 */
	public function deleteUser( $id )
	{
		$sql =
			'UPDATE 
    			user
    		SET
    			isActive = :isActive
    		WHERE 
    			id = :id AND canDelete = :canDelete';
		$this->db->execute( $sql, array( ':id' => $id, ':isActive' => 0, ':canDelete' => 1 ) );
	}

	/**
	 * @param $user_id
	 * @return array
	 */
	public function getRoleList( $user_id )
	{
		$placeholders = array
		(
			':user_id' => $user_id
		);

		$values = array();

		$sql = "SELECT 
				r.*,
				ur.user_id
    		FROM 
    			role r
    			LEFT JOIN user_role ur ON (r.id = ur.role_id AND ur.user_id = :user_id)
    		ORDER BY 
    			r.section ASC, r.priority ASC";
		$result = $this->db->fetchAll( $sql, $placeholders );
		$sectionNum = -1;
		$section = "";
		foreach( $result as $row )
		{
			if ( $section != $row['section'] )
			{
				$sectionNum++;
				$values[$sectionNum] = array
				(
					'name' => $row['section'],
					'roles' => array()
				);
			}
			$section = $row['section'];
			$set = ( (int)$row['user_id'] > 0 ) ? 1 : 0;
			$role_parts = explode( "_", $row['name'] );

			$record = array
			(
				'name' => $role_parts[0],
				'id' => $row['id'],
				'set' => $set
			);

			$values[$sectionNum]['roles'][] = $record;
		}

		return $values;
	}
}

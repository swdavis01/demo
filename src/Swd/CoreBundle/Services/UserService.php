<?php

namespace Swd\CoreBundle\Services;

use Swd\CoreBundle\Entity\Role;
use Swd\CoreBundle\Entity\User;
use Swd\CoreBundle\Entity\UserRole;
use Swd\CoreBundle\Services\CommonService;
use Swd\CoreBundle\Database\Database;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\RuntimeException;

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
		$query = $this->em->createQuery(
			'SELECT 
				u, r
    		FROM 
    			CoreBundle:User u
    			JOIN u.userRoles r 	
    		WHERE 
    			u.username = :username'
		)->setParameter('username', $username);

		//CommonService::debug( $username ); exit;

		try {
			$user = $query->getSingleResult();
		} catch ( \Doctrine\ORM\ORMException $e ) {
			throw new UsernameNotFoundException( "Unable to find user ", 0 );
		}

		//$user->debug(); exit;
		//CommonService::debug( $user->getRoles() ); exit;
		return $user;
	}

	/**
	 * @param $id
	 * @return User
	 */
	public function getUserById( $id )
	{
		/*$query = $this->em->createQuery(
			'SELECT 
				u, r
    		FROM 
    			CoreBundle:User u
    			JOIN u.userRoles r 	
    		WHERE 
    			u.id = :id'
		)->setParameter('id', $id);

		//CommonService::debug( $id ); exit;

		try {
			$user = $query->getSingleResult();
		} catch ( \Doctrine\ORM\ORMException $e ) {
			throw new UsernameNotFoundException( "Unable to find user", 0 );
		}*/

		$sql = 'SELECT 
				u.*,
				r.id AS role_id,
				r.name AS rowName,
				r.section AS rowSection,
				r.priority AS rowPriority
    		FROM 
    			user u
    			INNER JOIN user_role ur ON (u.id = ur.user_id)
    			INNER JOIN role r ON (r.id = ur.role_id)
    		WHERE 
    			u.id = :id';
		$result = $this->db->fetchAll( $sql, array( ':id' => $id ) );
		$user = new User();
		foreach( $result as $row )
		{
			$user->setId( $row['id'] );
			$user->setUsername( $row['username'] );
			$user->setName( $row['name'] );
			$user->setPassword( $row['password'] );
			$user->setCreated( $row['created'] );
			$user->setUpdated( $row['updated'] );

			$role = new Role();
			$role->setName( $row['rowName'] );
			$role->setSection( $row['rowSection'] );
			$role->setPriority( $row['rowPriority'] );

			$userRole = new UserRole();
			$userRole->setRoleId( $row['role_id'] );
			$userRole->setUserId( $row['id'] );
			$userRole->setRole( $role );

			$user->addUserRole( $userRole );
		}

		return $user;
	}

	/**
	 * @param $params array
	 * @return array
	 */
	public function getUsers( $params = array() )
	{
		$page = 1;
		$username = "asfsaf";

		extract( $params );

		//$result = $this->em->getRepository( 'CoreBundle:User' )->findAll();
		//print_r($users); exit;

		$query = $this->em->createQuery(
			'SELECT 
				u
    		FROM 
    			CoreBundle:User u
    		WHERE 
    			u.username != :username
    		ORDER BY 
    			u.username 
    		ASC'
		)->setParameter('username', $username);

		$result = $query->getResult();

		return $result;
	}

	private function deleteRoles( $user_id )
	{
		$query = $this->em->createQuery(
			'DELETE 
    		FROM 
    			CoreBundle:UserRole ur
    		WHERE 
    			ur.userId = :user_id'
		)->setParameter('user_id', (int)$user_id);

		//CommonService::debug($query); exit;

		try {
			$result = $query->execute();
		} catch ( \Doctrine\ORM\ORMException $e ) {
			CommonService::debug($e); exit;
			//throw new RuntimeException( "Error deleting user groups for user_id", 0 );
		}

		//$user->debug(); exit;
		return $result;

	}

	public function save( User $user )
	{
		if (strlen( $user->getPassword() ) > 0 )
		{
			$encoder = $this->encoderFactory->getEncoder($user);
			$encoded = $encoder->encodePassword( $user->getPassword(), "" );
			$user->setPassword($encoded);
		}

		$this->deleteRoles( $user->getId() );
		/*foreach($user->getUserRoles() as $userRole)
		{
			echo $userRole->getUserId() . ", " . $userRole->getRoleId() . "<br />";
		}*/

		$this->em->persist($user);
		$this->em->flush();
	}
}

<?php

namespace Swd\SecuredBundle\Providers;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\NoResultException;
use Swd\SecuredBundle\Entity\User;

class UserProvider implements UserProviderInterface
{
	protected $userRepository;
	protected $userRoleRepository;

	public function __construct(ObjectRepository $userRepository, ObjectRepository $userRoleRepository){
		$this->userRepository = $userRepository;
		$this->userRoleRepository = $userRoleRepository;
	}

	public function loadUserByUsername($username)
	{
		$user = $this->userRepository->findOneByUsername( $username );
		if ( is_object( $user ) )
		{
			$user = $this->setRoles( $user );
			return $user;
		}

		throw new UsernameNotFoundException( "Unable to find an admin user " . $username, 0 );
	}

	public function refreshUser(UserInterface $user)
	{
		$class = get_class($user);
		if (!$this->supportsClass($class)) {
			throw new UnsupportedUserException(
				sprintf(
					'Instances of "%s" are not supported.',
					$class
				)
			);
		}

		$user = $this->userRepository->find($user->getId());
		$user = $this->setRoles( $user );

		return $user;
	}

	public function supportsClass($class)
	{
		return $this->userRepository->getClassName() === $class || is_subclass_of($class, $this->userRepository->getClassName());
	}

	private function setRoles( User $user )
	{
		if ( is_object( $user ) )
		{
			$roles = $this->userRoleRepository->findByUserId( $user->getId() );
			if ( is_array( $roles ) )
			{
				$userRoles = array();
				foreach( $roles as $role )
				{
					$userRoles[] = $role->getRole();
				}
				$user->setRoles( $userRoles );
				//echo "<pre>"; print_r( $user ); echo "</pre>"; exit;
			}

			return $user;
		}

		throw new UsernameNotFoundException( "Unable to find user roles for " . $username, 0 );
	}
}
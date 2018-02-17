<?php

namespace Swd\SecuredBundle\Providers;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Swd\CoreBundle\Services\UserService;

class UserProvider implements UserProviderInterface
{
	/**
	 * @var UserService
	 */
	protected $service;

	/**
	 * UserProvider constructor.
	 * @param UserService $service
	 */
	public function __construct(UserService $service){
		$this->service = $service;
	}

	/**
	 * @param string $username
	 * @return \Swd\CoreBundle\Object\User
	 */
	public function loadUserByUsername($username)
	{
		$user = $this->service->getUserByUsername( $username );
		if ( !is_object( $user ) )
		{
			throw new UsernameNotFoundException( "Unable to find user " . $username, 0 );
		}

		return $user;
	}

	/**
	 * @param UserInterface $user
	 * @return \Swd\CoreBundle\Object\User|UserInterface
	 */
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

		$user = $this->service->getUserById( $user->getId() );
		if ( !is_object( $user ) )
		{
			throw new UsernameNotFoundException( "Unable to refresh user", 0 );
		}

		return $user;
	}

	/**
	 * @param string $class
	 * @return bool
	 */
	public function supportsClass($class)
	{
		return $class === "Swd\\CoreBundle\\Object\\User";
	}
}
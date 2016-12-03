<?php

namespace Swd\SecuredBundle\Repository;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository implements UserProviderInterface
{
	public function loadUserByUsername($username)
	{
		/*$user = $this->findOneByUsernameOrEmail($username);

		if (!$user) {
			throw new UsernameNotFoundException('No user found for username '.$username);
		}

		return $user;*/
		//echo "UserRepository"; exit;
		return $this->createQueryBuilder('u')
			->where('u.username = :username OR u.email = :email')
			->setParameter('username', $username)
			->setParameter('email', $username)
			->getQuery()
			->getOneOrNullResult();
	}

	public function refreshUser(UserInterface $user)
	{
		if (!$user instanceof WebserviceUser) {
			throw new UnsupportedUserException(
				sprintf('Instances of "%s" are not supported.', get_class($user))
			);
		}

		return $this->loadUserByUsername($user->getUsername());
	}

	public function supportsClass($class)
	{
		return $class === 'AppBundle\Security\User\WebserviceUser';
	}
}

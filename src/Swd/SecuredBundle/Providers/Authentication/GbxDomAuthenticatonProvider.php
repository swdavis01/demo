<?php

namespace Swd\SecuredBundle\Providers\Authentication;
 
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\AuthenticationServiceException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
 
use Swd\SecuredBundle\Providers\Authentication\AbstractAuthenticator;

class GbxDomAuthenticatonProvider extends AbstractAuthenticator 
{
  /**
   * {@inheritdoc}
   */
  protected function checkAuthentication(UserInterface $user, UsernamePasswordToken $token)
  {
    $currentUser = $token->getUser();

    if ($currentUser instanceof UserInterface) {
      if ($currentUser->getPassword() !== $user->getPassword()) {
          throw new BadCredentialsException('The credentials were changed from another session.');
      }
    } else {

      $presentedPassword = $token->getCredentials();
      if( empty($presentedPassword) ) {
        throw new BadCredentialsException('The presented password cannot be empty.');
      }

      if( ! $this->encoderFactory->getEncoder($user)->isPasswordValid($user->getPassword(), $presentedPassword, false) ) {
        throw new BadCredentialsException('The presented password is invalid.');
      }
    }
  }
    
    
  /**
   * {@inheritdoc}
   */
  protected function retrieveUser($username, UsernamePasswordToken $token)
  {
    $user = $token->getUser();
    if ($user instanceof UserInterface) {
      return $user;
    }

    try {
      $user = $this->userProvider->loadUserByUsername($username);

      if (!$user instanceof UserInterface) {
        throw new AuthenticationServiceException('The user provider must return a UserInterface object.');
      }

      return $user;
    } catch (UsernameNotFoundException $notFound) {
      throw $notFound;
    } catch (\Exception $repositoryProblem) {
      throw new AuthenticationServiceException($repositoryProblem->getMessage(), $token, 0, $repositoryProblem);
    }
  }
}
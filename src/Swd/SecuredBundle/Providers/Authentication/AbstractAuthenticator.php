<?php

namespace Swd\SecuredBundle\Providers\Authentication;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AuthenticationServiceException;
use Symfony\Component\Security\Core\Authentication\Provider\UserAuthenticationProvider;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;


abstract class AbstractAuthenticator extends UserAuthenticationProvider
{
  /**
   * @var \Symfony\Component\Security\Core\User\UserProviderInterface 
   */
  protected $userProvider   = null;

  /**
   *
   * @var \Symfony\Component\HttpFoundation\Session\Session
   */
  protected $session;
  
  /**
   * @var \Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface 
   */
  protected $encoderFactory = null;
  
  /**
   * @param \Symfony\Component\Security\Core\User\UserProviderInterface $userProvider
   * @param \Symfony\Component\Security\Core\User\UserCheckerInterface $userChecker
   * @param $providerKey
   * @param \Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface $encoderFactory
   * @param bool $hideUserNotFoundExceptions
   */
  public function __construct(UserProviderInterface $userProvider, 
                             UserCheckerInterface $userChecker, 
                             $providerKey, 
                             EncoderFactoryInterface $encoderFactory, 
                             $hideUserNotFoundExceptions = true)
  {
     parent::__construct($userChecker, $providerKey, $hideUserNotFoundExceptions);
     $this->encoderFactory   = $encoderFactory;
     $this->userProvider     = $userProvider;
  }
  
 
  /**
   * 
   * @param \Symfony\Component\HttpFoundation\Session $session
   * @return \GbxCore\SecuredBundle\Providers\Authentication\GbxDomAuthenticatonProvider
   */
  public function setSession(Session $session)
  {
    $this->session = $session;
    return $this;
  }

  /**
   * 
   * @return \Symfony\Component\HttpFoundation\Session
   */
  public function getSession()
  {
    return $this->session;
  }
  
  
  /**
   * @return \Symfony\Component\Security\Core\User\UserProviderInterface
   */
  protected function getUserProvider()
  {
    return $this->userProvider;
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
      $user = $this->getUserProvider()->loadUserByUsername($username);

      if (!$user instanceof UserInterface) {
        throw new AuthenticationServiceException('The user provider must return a UserInterface object.');
      }

      return $user;
      
    } catch (UsernameNotFoundException $notFound) {
      throw $notFound;
      
    } catch (\Exception $e) {
      throw new AuthenticationServiceException($e->getMessage(), 0, $e);
    }
  }
}

<?php

namespace Swd\SecuredBundle\Providers\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
//use Gbx\DomBundle\DomSystem;
//use Gbx\DomBundle\Model\TypeofGbxUsergroup;
//use Gbx\DomBundle\Model\GbxUser;
//use Gbx\DomBundle\Query\Query;
//use GbxCore\SecuredBundle\Model\SecurityUser;
//use GbxCore\SecuredBundle\Services\GbxPermissionService;
use Symfony\Component\HttpFoundation\Request;
use Swd\SecuredBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class GbxDomUserProvider implements UserProviderInterface
{

  /**
   * @var array
   */
  protected $security_params;
  
  /**
   *
   * @var \Symfony\Component\DependencyInjection\ContainerInterface
   */
  protected $container;

  
  /**
   * 
   * @param \Symfony\Component\HttpFoundation\Request
   * @param \Symfony\Component\HttpFoundation\Session\Session $session
   * @param array $security_session
   */
  public function __construct(Session $session=null, array $security_params, ContainerInterface $container)
  {
    $this->session         = $session;
    $this->security_params = $security_params;
    $this->container       = $container;
  }

  /**
   * 
   * @return \Symfony\Component\HttpFoundation\Session\Session
   */
  protected function getSession()
  {
    return $this->session;
  }
  
  /**
   * 
   * @return boolean
   */
  protected function hasSession()
  {
    return $this->getSession() instanceof Session;
  }
  
  /**
   * 
   * @return array
   */
  protected function getSecurityParams()
  {
    return $this->security_params;
  }
  
  /**
   * @return \Symfony\Component\HttpFoundation\Request;
   */
  protected function getRequest()
  {
    return $this->container->get('request');;
  }
  
  
  /**
   * 
   * @param string $param
   * @return mixed
   */
  protected function getSecurityParamter($param)
  {
    return $this->getSecurityParams()[$param];
  }

  
  /**
   * returns number of refreshes if the session is working
   * 
   * @return int
   */
  protected function getReloads()
  {
    if( $this->hasSession() ) {
      return $this->getSession()->get('security.userreload');
    }
    return $this->getSecurityParamter('refreshesAllowed') + 100;
  }
  
  /**
   * if session is enabled, set the number of reloads
   * 
   * @param int $reloads
   */
  protected function setReloads($reloads)
  {
    if( $this->hasSession() ) {
      $this->getSession()->set('security.userreload', $reloads);
    }
    return $this;
  }
  
  
  /**
   * 
   * @param string $username
   * @return \GbxCore\SecuredBundle\Model\SecurityUser
   * @throws UsernameNotFoundException
   */
  public function loadUserByUsername($username)
  {
    /*$user = $this->getDomSystem()->getUser( $username );

    if ($user instanceof GbxUser) {
      $security_user = new SecurityUser( $user->getGbxUserHandle(), $user->getGbxUserPasswd(), '', $this->getRoles( $user ) );
      $security_user->setPasswordSetDate($user->getGbxUserPasswdreset());
      $security_user->setPasswordExpireDays($user->getPasswordExpireDays());
      return $security_user;
    }*/

    //echo "I'm Mr Meseeks Look at me"; exit;

    throw new UsernameNotFoundException( sprintf( 'Username "%s" does not exist.', $username ) );
  }

  /**
   * 
   * @param \Gbx\DomBundle\Model\GbxUser $user
   * @return array
   */
  /*private function getRoles(GbxUser $user)
  {
    $roles = array();
    
    $gbx_usergroups = $user->getMembers( 'GbxUsergroup' );
    $roles[] = 'ROLE_LOGIN';
    foreach ($gbx_usergroups as $group) {
      $group = $group->getTypeofGbxUsergroup();
      if ($group instanceof TypeofGbxUsergroup) {
        
        $role = $group->getTypeofGbxUsergroupScode();
        $roles[] = 'ROLE_' . $role;
        $roles = array_merge( $roles, $this->permissions->getPermissionsByRole( $role ) );
      }
    }

    return $roles;
  }*/


  /**
   * 
   * @param \Symfony\Component\Security\Core\User\UserInterface $user
   * @return \GbxCore\SecuredBundle\Model\SecurityUser
   * @throws UnsupportedUserException
   */
  public function refreshUser(UserInterface $user)
  {
    /*if (!$user instanceof SecurityUser) {
      throw new UnsupportedUserException( sprintf( 'Instances of "%s" are not supported.', get_class( $user ) ) );
    }*/

    /**
     * The ideal here is to connect to the database and retrieve the user again,
     * set any roles etc. Given the slowness of the DOM, this can take >100ms
     * we do this round-trip after 'X' reloads. 
     */
    
    $caching_enabled = $this->getSecurityParamter('refreshCaching');
    $caching_reloads = $this->getSecurityParamter('refreshesAllowed');
    $reloads         = $this->getReloads();

    //if we're doing a JSON request, assume the main page goes through the reloading process already
    if( $this->getRequest()->isXmlHttpRequest() ) {
      return $user;
    }
    
    if( $caching_enabled && $caching_reloads >= $reloads) {
      //if we're running through the Manager query interface, don't increment
      //just increment on page loads
      $this->setReloads(++$reloads);
     
      //increment the refreshes completed
      //return the user we just had
      return $user;
    }

    //grab the user from the DOM
    $user_reloaded = $this->loadUserByUsername( $user->getUsername() );
    
    //reset the reload
    $this->setReloads(1);
    
    return $user_reloaded;
  }

  /**
   * 
   * @param string $class
   * @return boolean
   */
  public function supportsClass($class)
  {
    return $class === 'Swd\SecuredBundle\Entity\User';
  }

}

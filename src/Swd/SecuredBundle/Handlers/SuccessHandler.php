<?php

namespace Swd\SecuredBundle\Handlers;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;

use Swd\SecuredBundle\Exceptions\RedirectException;

/**
 * Description of LoginListener
 *
 * @author Stefan Carlton <stefan.carlton@greenbox-group.com>
 */
class SuccessHandler extends DefaultAuthenticationSuccessHandler
{
  /**
   * @var \Symfony\Component\Routing\RouterInterface 
   */
  protected $router;
  
  /**
   * @var \Symfony\Component\HttpFoundation\Session\Session 
   */
  protected $session;
  
  /**
   * @var \Gbx\DomBundle\Dom 
   */
  protected $dom;
  
  /**
   * @var \Symfony\Component\DependencyInjection\Container
   */
  protected $container;

  
  /**
   * @author Stefan Carlton <stefan.carlton@greenbox-group.com>
   * @access public
   * @param \Symfony\Component\HttpFoundation\Session\Session $session
   * @return \GbxCore\SecuredBundle\Handlers\SuccessHandler
   */
  public function setSession(Session $session)
  {
    $this->session = $session;
    return $this;
  }
  
  
  /**
   * @author Stefan Carlton <stefan.carlton@greenbox-group.com>
   * @access public
   * @return \Symfony\Component\HttpFoundation\Session\Session
   */
  public function getSession()
  {
    return $this->session;
  }
  

  /**
   * @author Stefan Carlton <stefan.carlton@greenbox-group.com>
   * @access public
   * @param \Symfony\Component\Routing\RouterInterface $router
   * @return \GbxCore\SecuredBundle\Handlers\SuccessHandler
   */
  public function setRouter(RouterInterface $router)
  {
    $this->router = $router;
    return $this;
  }
  
  
  /**
   * @author Stefan Carlton <stefan.carlton@greenbox-group.com>
   * @access public
   * @return \Symfony\Component\Routing\RouterInterface
   */
  public function getRouter()
  {
    return $this->router;
  }
  
  
  /**
   * @author Stefan Carlton <stefan.carlton@greenbox-group.com>
   * @access public
   * @param \Symfony\Component\DependencyInjection\Container $container
   * @return \GbxCore\SecuredBundle\Handlers\SuccessHandler
   */
  public function setContainer(Container $container)
  {
    $this->container = $container;
    return $this;
  }
  
  
  /**
   * @author Stefan Carlton <stefan.carlton@greenbox-group.com>
   * @access public
   * @return \Symfony\Component\DependencyInjection\Container
   */
  public function getContainer()
  {
    return $this->container;
  }
  
  
  /**
   * Gets the dom from the Container - necessary to do it this way as the 
   * DOM connects on construction, which requires a valid user
   * 
   * @author Stefan Carlton <stefan.carlton@greenbox-group.com>
   * @access public
   * @return \Gbx\DomBundle\Dom
   */
  public function getDom()
  {
    return $this->getContainer()->get('gbx_dom');
  }
  
  
  /**
   * @author Stefan Carlton <stefan.carlton@greenbox-group.com>
   * @access public
   * @param \Symfony\Component\Security\Http\Event\InteractiveLoginEvent $event
   */
  public function onAuthenticationSuccess(Request $request, TokenInterface $token)
  {
    // session variable to return to referring page
    /*$session = $this->container->get( 'session' );
    $gbx_login_redirect = $session->get( 'gbx_login_redirect' );
    if ( strlen( $gbx_login_redirect ) == 0 && strlen( $request->request->get( '_login_redirect' ) ) > 0 && !strstr( $request->request->get( '_login_redirect' ), 'login' ) )
    {
      $session->set( 'gbx_login_redirect', $request->request->get( '_login_redirect' ) );
    }*/

    try {
      $this->doAuthSuccess($request, $token);
    } catch (RedirectException $ex) {
      return new RedirectResponse($ex->getUri());
    }

    /*$gbx_login_redirect = $session->get( 'gbx_login_redirect' );
    if ( strlen( $gbx_login_redirect ) > 0 )
    {
      return new RedirectResponse( $gbx_login_redirect );
    }*/

    return parent::onAuthenticationSuccess($request, $token);
  }
  
  
  /**
   * @author Stefan Carlton <stefan.carlton@greenbox-group.com>
   * @access protected
   * @param \GbxCore\SecuredBundle\Handlers\Request $request
   * @param \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token
   * @throws \GbxCore\SecuredBundle\Exceptions\RedirectException
   */
  protected function doAuthSuccess(Request $request, TokenInterface $token)
  {
    $this->checkForPasswordExpiry($token);
  }
  
  
  /**
   * Checks if the user has an expired password and redirect accordingly
   * 
   * @author Stefan Carlton <stefan.carlton@greenbox-group.com>
   * @access protected
   * @param \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token
   * @throws \GbxCore\SecuredBundle\Exceptions\RedirectException
   */
  protected function checkForPasswordExpiry(TokenInterface $token)
  {
    if( $token->getUser()->hasPasswordExpired() ) {
      throw new RedirectException( $this->getRouter()->generate('change_password') );
    }
  }
}

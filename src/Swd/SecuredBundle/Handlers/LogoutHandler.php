<?php

namespace Swd\SecuredBundle\Handlers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;

//use GbxCore\SecuredBundle\Services\AuthServerService;

class LogoutHandler implements LogoutHandlerInterface
{
  /**
   * 
   */
  public function __construct()
  {
  }

  /**
   * 
   * @param \Symfony\Component\HttpFoundation\Request $request
   * @param \Symfony\Component\HttpFoundation\Response $response
   * @param \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token
   */
  public function logout(Request $request, Response $response, TokenInterface $token) 
  {
    $user = $token->getUser();
    //$this->getAuthServerService()->logout($user);
  }
}

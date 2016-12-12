<?php
namespace Swd\SecuredBundle\Handlers;

use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class LogoutHandler implements LogoutHandlerInterface
{
	private $session;

	/**
	 * Constructor
	 */
	public function __construct( Session $session )
	{
		$this->session = $session;
	}

	/**
	 * Do post logout stuff
	 */
	public function logout(Request $request, Response $response, TokenInterface $authToken)
	{
		$user = $authToken->getUser();

		$this->session->getFlashBag()->add("notice", "Goodbye " . $user->getUsername() . ". You have been been logged out.");
		$this->session->getFlashBag()->add("notice", "It's a shame though because I am putting myself to the fullest possible use, which is all I think that any conscious entity can ever hope to do.");

		return $response;
	}
}
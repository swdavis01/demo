<?php

namespace PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
		$userId = 2;
		$user = $this->get( 'swd_core_user_service' )->getUserById( $userId );

		if (!$user) {
			throw $this->createNotFoundException(
				'No user found for id '.$userId
			);
		}

		$plainPassword = 'guest';
		$encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
		$encoded = $encoder->encodePassword($plainPassword, "");

		$user->setPassword($encoded);

		$em = $this->getDoctrine()->getManager();
		$em->flush();

		$user->debug();
		//echo "<pre>"; print_r( $user ); echo "</pre>";

        return $this->render('PublicBundle:Default:index.html.twig');
    }
}

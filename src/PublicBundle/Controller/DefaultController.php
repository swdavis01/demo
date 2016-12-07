<?php

namespace PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
		$userId = 1;
		$user = $this->getDoctrine()
			->getRepository('SecuredBundle:User')
			->find($userId);

		if (!$user) {
			throw $this->createNotFoundException(
				'No user found for id '.$userId
			);
		}

		/*$plainPassword = 'admin';
		$encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
		$encoded = $encoder->encodePassword($user->getUsername(), $plainPassword);

		$user->setPassword($encoded);

		$em = $this->getDoctrine()->getManager();
		$em->flush();*/

		echo "<pre>"; print_r( $user ); echo "</pre>";

        return $this->render('PublicBundle:Default:index.html.twig');
    }
}

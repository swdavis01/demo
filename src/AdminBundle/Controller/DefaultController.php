<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
		/*if( $this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY') )
		{
			echo "Yes";
		}*/
        return $this->render('AdminBundle:Default:index.html.twig');
    }
}

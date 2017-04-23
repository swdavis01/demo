<?php

namespace Swd\AssetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AssetBundle:Default:index.html.twig');
    }
}

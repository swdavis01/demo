<?php

namespace Swd\MusicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MusicBundle:Default:index.html.twig');
    }
}

<?php

namespace VICTORVIS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VICTORVISUserBundle:Default:index.html.twig');
    }   
}

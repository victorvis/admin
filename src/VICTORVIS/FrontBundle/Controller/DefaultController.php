<?php

namespace VICTORVIS\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VICTORVISFrontBundle:Default:index.html.twig');
    }
}

<?php

namespace VICTORVIS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $security = $this->get('security.context');
        $user = $security->getToken()->getUser();

        return $this->render(
            'VICTORVISAdminBundle:Default:index.loggedIn.html.twig',
            compact('user')
        );
    }
}

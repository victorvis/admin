<?php

namespace VICTORVIS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $security = $this->get('security.context');
        if (false === $security->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        } else {
            $user = $security->getToken()->getUser();

            return $this->render(
                'VICTORVISAdminBundle:Default:index.loggedIn.html.twig',
                compact('user')
            );
        }
    }
}

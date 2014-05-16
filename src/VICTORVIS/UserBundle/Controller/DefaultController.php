<?php

namespace VICTORVIS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VICTORVISUserBundle:Default:index.html.twig');
    }

    /**
     * @Route("/login/facebook", name="lc_link_facebook")
     */
    public function facebookLoginAction()
    {
        $shouldLogout = $this->getRequest()->get('logout');
        if (! is_null($shouldLogout)) {
            $this->get('session')->set('facebook.logout', true);
        }

        $api = $this->container->get('fos_facebook.api');
        $scope = implode(',', $this->container->getParameter('facebook_app_scope'));
        $callback = $this->container->get('router')->generate('_security_check_facebook', array(), true);
        $redirect_url = $api->getLoginUrl(array(
            'scope' => $scope,
            'redirect_uri' => $callback
        ));

        return new RedirectResponse($redirect_url);
    }

    public function loginFbAction()
    {
        exit('implements callback');
    }    
}

<?php

namespace VICTORVIS\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VICTORVISFrontBundle:Default:index.html.twig');
    }

    public function listAction()
    {
        return $this->render('VICTORVISFrontBundle:Default:list.html.twig');
    }

    public function listPdfAction()
    {
        $pageUrl = $this->generateUrl('victorvis_front_list', array(), true);

        return new \Symfony\Component\HttpFoundation\Response(
            $this->get('knp_snappy.pdf')->getOutput($pageUrl),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'
            )
        );
    }
}

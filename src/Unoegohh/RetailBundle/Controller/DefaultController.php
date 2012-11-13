<?php

namespace Unoegohh\RetailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('UnoegohhAdminBundle:Page')->findOneBy(array('url' => 'index'));
        return $this->render('UnoegohhRetailBundle:Default:index.html.twig', array(
            'page' => $page,
        ));
    }
}

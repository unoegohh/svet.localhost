<?php

namespace Unoegohh\RetailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction($url)
    {

        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('UnoegohhAdminBundle:Page')->findOneBy(array('url' => $url,'enabled' => true));

        if(count($page) < 1){
            // НАДО СДЕЛАТЬ !!!!! СУКА ПОСМОТРИ СЮДА!!!!!!!!! НААААААААДДДДОООООО!!!!!
        }
        return $this->render('UnoegohhRetailBundle:Page:page.html.twig', array('page' => $page));
    }
}

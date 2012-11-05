<?php

namespace Unoegohh\RetailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{
    public function topMenuAction()
    {

        $success = false;
        $key = 'topMenu';
        $menu = apc_fetch($key, $success);

        if (!$success) {
            $em = $this->getDoctrine()->getManager();
            $menu = $em->getRepository('UnoegohhAdminBundle:Page')->findBy(array('enabled' => true,'menuTop' => true),array('position' => "ASC"));
            apc_store($key, $menu);
        }

        return $this->render('UnoegohhRetailBundle:Menu:topMenu.html.twig', array(
            'menu' => $menu,
        ));
    }
    public function leftMenuAction()
    {

        $successMenu = false;
        $successCat = false;
        $key = 'leftMenu';
//        $menu = apc_fetch($key, $successMenu);
//        $category = apc_fetch($key, $successCat);

        if (!$successMenu && !$successCat) {
            $em = $this->getDoctrine()->getManager();
            $menu = $em->getRepository('UnoegohhAdminBundle:Page')->findBy(array('enabled' => true,'menuLeft' => true),array('position' => "ASC"));
            $category = $em->getRepository('UnoegohhAdminBundle:ProductCategory')->findBy(array('enabled' => true),array('position' => "ASC"));
            apc_store($key, $menu);
        }

        return $this->render('UnoegohhRetailBundle:Menu:leftMenu.html.twig', array(
            'menu' => $menu,
            'category' => $category
        ));
    }
}

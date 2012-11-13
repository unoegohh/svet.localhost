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
            $menu = $em->getRepository('UnoegohhAdminBundle:Page')->findBy(array('enabled' => true,'menuTop' => true),array('position' => "Desc"));
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
        $keyMenu = 'leftMenu';
        $keyCat = 'leftCat';
        $menu = apc_fetch($keyMenu, $successMenu);
        $category = apc_fetch($keyCat, $successCat);

        if (!$successMenu && !$successCat) {
            $em = $this->getDoctrine()->getManager();
            $menu = $em->getRepository('UnoegohhAdminBundle:Page')->findBy(array('enabled' => true,'menuLeft' => true),array('position' => "Desc"));
            $category = $em->getRepository('UnoegohhAdminBundle:ProductCategory')->findBy(array('enabled' => true),array('position' => "Desc"));
            apc_store($keyMenu, $menu);
            apc_store($keyCat, $category);
        }

        return $this->render('UnoegohhRetailBundle:Menu:leftMenu.html.twig', array(
            'menu' => $menu,
            'category' => $category
        ));
    }
    public function cartMenuAction()
    {

        $session = $this->getRequest()->getSession();
        $cart = $session->get('cart');

        $count = 0;
        if(is_array($cart)){
            foreach($cart as $item){
                $count = $count + $item['count'];
            }
        }

        return $this->render('UnoegohhRetailBundle:Menu:cartMenu.html.twig', array(
            'count' => $count,
        ));
    }
}

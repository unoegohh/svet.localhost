<?php

namespace Unoegohh\RetailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;


class ShopController extends Controller
{
    public function categoryAction($name)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('UnoegohhAdminBundle:ProductCategory')->findOneBy(array('url' => $name));
        $products = $em->getRepository('UnoegohhAdminBundle:Product')->findBy(array('enabled' => true,'category' => $category->getId()),array('position' => "Desc"));

        return $this->render('UnoegohhRetailBundle:Shop:category.html.twig', array('products'=>$products, 'category' => $category));
    }

    public function itemAction($name,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository('UnoegohhAdminBundle:Product')->findOneBy(array('enabled' => true,'id' => $id));

        return $this->render('UnoegohhRetailBundle:Shop:item.html.twig', array('item'=>$item));
    }

    public function addAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository('UnoegohhAdminBundle:Product')->findOneBy(array('enabled' => true,'id' => $id));
        $session = $this->getRequest()->getSession();
        $cart = $session->get('cart');

        if(!isset($cart[$id])){
            $cart[$id] = array('name'=>$item->getName(), 'price' => $item->getPrice(), 'count' => 1, 'id' => $item->getId());
        }else{
            $cart[$id]['count'] = $cart[$id]['count']+1;
        }
        $session->set('cart', $cart);
//        $session->set('cart', '');

        return new Response('ok', 200);
    }

    public function removeAction($id)
    {
        $session = $this->getRequest()->getSession();
        $cart = $session->get('cart');
        unset($cart[$id]);
        $session->set('cart', $cart);
        return new Response('ok', 200);
    }

    public function editAction($id,$count)
    {
        $session = $this->getRequest()->getSession();
        $cart = $session->get('cart');
        $cart[$id]['count'] = $count;

        $session->set('cart', $cart);
        return new Response('ok', 200);
    }

    public function cartAction()
    {
        $session = $this->getRequest()->getSession();
        $cart = $session->get('cart');
        if($cart != ''){
            $total_price = 0;
            $total_count = 0;

            foreach($cart as $item){
                $total_price = $total_price + ($item['price'] * $item['count']);
                $total_count = $total_count + $item['count'];

            }

            return $this->render('UnoegohhRetailBundle:Shop:cart.html.twig', array(
                'cart' => $cart,
                'price' => $total_price,
                'count' => $total_count,
                'empty' => false
            ));
        }else{
            return $this->render('UnoegohhRetailBundle:Shop:cart.html.twig', array(
                'empty' => true
            ));
        }

    }
    public function orderAction(Request $request)
    {
        $session = $this->getRequest()->getSession();
        $cart = $session->get('cart');
        $total_price = 0;
        $total_count = 0;

        foreach($cart as $item){
            $total_price = $total_price + ($item['price'] * $item['count']);
            $total_count = $total_count + $item['count'];
        }
        $form = $this->createFormBuilder()
            ->add('context', 'textarea', array('label' => 'Коментарии', 'attr' => array('class'=> 'lol')))
            ->add('name', 'text', array('label' => 'Ваше ФИО', 'attr' => array('class'=> 'lol')))
            ->add('address', 'text', array('label' => 'Адрес', 'attr' => array('class'=> 'lol')))
            ->add('phone', 'text', array('label' => 'Телефон', 'attr' => array('class'=> 'lol')))
            ->add('email', 'text', array('label' => 'Email', 'attr' => array('class'=> 'lol')))
            ->getForm();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $order = $form->getData();

                $message = $this->get('mailer')->createMessage()
                    ->setSubject('Заказ с сайта')
                    ->setFrom(array($this->container->getParameter('mail_from') => $this->container->getParameter('mail_name')))
                    ->setBody($this->renderView('UnoegohhRetailBundle:Mail:mail.html.twig', array(
                        'order' => $order,
                        'cart' => $cart,
                        'total_price' => $total_price,
                        'total_count' => $total_count,
                    )), 'text/html')
                    ->addTo($this->container->getParameter('mail_to'));

//                $this->get('mailer')->send($message);
                $session->set('cart', '');

                return $this->redirect($this->generateUrl('unoegohh_retail_mail_ok'));

            }
        }

        return $this->render('UnoegohhRetailBundle:Shop:order.html.twig', array(
            'cart' => $cart,
            'price' => $total_price,
            'count' => $total_count,
            'form' => $form->createView()
        ));
    }

    public function mailOkAction()
    {
        return $this->render('UnoegohhRetailBundle:Mail:mailOk.html.twig');
    }
}

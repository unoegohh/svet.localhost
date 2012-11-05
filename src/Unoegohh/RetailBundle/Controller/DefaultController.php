<?php

namespace Unoegohh\RetailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UnoegohhRetailBundle:Default:index.html.twig');
    }
}

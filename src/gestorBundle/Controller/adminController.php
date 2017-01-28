<?php

namespace gestorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class adminController extends Controller
{
    public function indexAction()
    {
        return $this->render('gestorBundle:admin:index.html.twig');
    }
}

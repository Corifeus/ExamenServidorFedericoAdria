<?php

namespace gestorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use gestorBundle\Entity\User;
use gestorBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;


class usuariosController extends Controller
{

    public function usuariosAction()
    {
        return $this->render('gestorBundle:usuarios:usuarios.html.twig');
    }

    public function loginAction()
    {
      $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('gestorBundle:usuarios:login.html.twig', array(
        'last_username' => $lastUsername,
        'error'         => $error,
      ));
    }
}

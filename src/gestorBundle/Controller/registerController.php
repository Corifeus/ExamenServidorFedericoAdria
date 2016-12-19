<?php

namespace gestorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use gestorBundle\Entity\User;
use gestorBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;


class registerController extends Controller
{

    public function indexAction()
    {
        return $this->render('gestorBundle:Default:index.html.twig');
    }

    public function registrarAction(Request $request)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('Usuario_Registrado');
        }

        return $this->render(
            'gestorBundle:register:register.html.twig',
            array('form' => $form->createView())
        );
    }

    public function msgExitoAction()
    {
        return $this->render('gestorBundle:register:msgExito.html.twig');
    }
}

<?php

namespace gestorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//Recibimos el formulario y los datos de la entidad que usaremos
use gestorBundle\Entity\conf;
use gestorBundle\Form\confType;

use Symfony\Component\HttpFoundation\Request;

class confController extends Controller
{
    public function confAllAction()
    {
      //Usaremos la entidad conf
      $repository= $this->getDoctrine()->getRepository('gestorBundle:conf');

      // recogemos un listado de todas las configuraciones
      $conf = $repository->findAll();
        return $this->render('gestorBundle:conf:all.html.twig',array("conf"=>$conf));
    }

    public function nuevaConfAction(Request $request)
    {
      //Creamos una conf
      $conf=new conf();

      //Obtenemos el formulario de la entidad conf para enviarlo posteriormente al html twig
      $form= $this->createForm(confType::class);

      //Obtenemos el formulario para luego hacer comprobaciones
      $form->handleRequest($request);

      //Si se ha rellenado correctamente un formulario procedemos a insertar los datos en la base de datos correspondiente
      if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original '$task' variable has also been updated

        //Obtenemos los datos de el formulario y los guardamos en la variable conf
        //usamos este nombre porque es el mismo que la entidad con la que trabajamos pero podría ser cualquier variable con otro nombre
        $conf = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!

        //al estar rellenado el formulario y estar todo correcto guardamos los datos en la base de datos
        $em = $this->getDoctrine()->getManager();
        $em->persist($conf);
        $em->flush();

        //Nos redirigimos a una ruta donde mostraremos un mensaje al usuario
        //de esta forma sabe que ha tenido éxito en la operación
        return $this->redirectToRoute('conf_msgExito');
      }

      //si el formulario no ha sido rellenado lo mostraremos para realizar las operaciones pertinentes
      return $this->render('gestorBundle:conf:nuevaConf.html.twig',array("form"=>$form->createView() ));
    }

    public function msgExitoAction()
    {
        //Tan solo mostramos un html que diga que hemos creado la configuración correctamente
        return $this->render('gestorBundle:conf:msgExito.html.twig');
    }
}

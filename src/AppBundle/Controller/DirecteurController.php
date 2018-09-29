<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DirecteurController extends Controller
{
    /**
     * @Route("/directeur",name="directeur_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $documents = $em->getRepository('AppBundle:Document')->findAll();

        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('AppBundle:Directeur:index.html.twig', array(
            "documents" => $documents,
            "users" => $users
        ));
    }

}

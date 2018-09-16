<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TechnicienController extends Controller
{
    /**
     * @Route("/technicien",name="technicien_index")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Technicien:index.html.twig', array(
            // ...
        ));
    }

}

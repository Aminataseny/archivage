<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecretaireController extends Controller
{
    /**
     * @Route("/secretaire",name="secretaire_index")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Secretaire:index.html.twig', array(
            // ...
        ));
    }

}

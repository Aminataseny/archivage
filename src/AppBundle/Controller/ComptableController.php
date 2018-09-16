<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ComptableController extends Controller
{
    /**
     * @Route("/comptable",name="comptable_index")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Comptable:index.html.twig', array(
            // ...
        ));
    }

}

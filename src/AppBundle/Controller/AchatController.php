<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AchatController extends Controller
{
    /**
     * @Route("/achat",name="achat_index")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Achat:index.html.twig', array(
            // ...
        ));
    }

}

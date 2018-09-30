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
        return  true;
    }

}

<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/roles", name="default_index")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/redirection",name="redirection")
     */
    public function redirectionAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $users = $request->get('users');
        $commentaire = $request->get('commentaire');
        $document = $request->get('document');
        $route = $request->get('route_current');

        if($users){
            foreach ($users as $user) {
                $user = $em->getRepository('AppBundle:User')->find($user);
                if($user){
                    if ($document) {
                        $document = $em->getRepository('AppBundle:Document')->find($document) ;
                        $user->addDocument($document) ;

                        return $this->redirectToRoute($route) ;
                    }
                }
            }
        }

        //$this->redirectToRoute()

        return $this->redirectToRoute($route) ;
    }
}

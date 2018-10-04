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
        // dump($request); die;
        if($users){
            foreach ($users as $user) {
                $user = $em->getRepository('AppBundle:User')->find($user);

                // dump($user); die;

                if($user){
                    $document = $em->getRepository('AppBundle:Document')->find($document) ;
                    $document->setCommentaire($commentaire);
                    $document->addUser($user);
                    $em->persist($document);
                    $em->flush();


                    // Retrieve flashbag from the controller
                    $flashbag = $this->get('session')->getFlashBag();
                    $flashbag->add("success", "Votre document a été bien transféré.");

                    return $this->redirectToRoute($route) ;
                }
            }
        }

        //$this->redirectToRoute()

        return $this->redirectToRoute($route) ;
    }

    /**
     * @Route("/", name="dashboard")
     */
    public function dashboardAction() {
        $em = $this->getDoctrine()->getManager();

        //$documents = $em->getRepository('AppBundle:Document')->findAll();
        $documents = $this->getUser()->getDocuments();
        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('default\dashboard.html.twig', array(
            "documents" => $documents,
            "users" => $users
        ));
    }


}

<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{
    /**
     * @Route("/admin",name="admin_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('AppBundle:Admin:index.html.twig', array(
            "users" => $users
        ));
    }

    /**
     * @Route("/enabled/{status}/{user}",name="enabled")
     */
    public function enabledAction($status, $user) {
        $em = $this->getDoctrine()->getManager();

        $user_selected = $em->getRepository('AppBundle:User')->find($user);
        $username = $user_selected->getUsername();

        // Retrieve flashbag from the controller
        $flashbag = $this->get('session')->getFlashBag();

        if($status == 1) {
            $user_selected->setEnabled(true);
            // Add flash message
            $flashbag->add("success_approve", "L'utilisateur '$username' a été activé !");
        }
        if($status == 0) {
            $user_selected->setEnabled(false);
            // Add flash message
            $flashbag->add("failed_approve", "L'utilisateur '$username' a été désactivé !");
        }

        $em->persist($user_selected);
        $em->flush();


        return $this->redirectToRoute('admin_index') ;
    }

    /**
     * @Route("/admin/statistics",name="admin_stats")
     */
    public function statsAction()
    {

        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('AppBundle:Categorie')->findAll();

        $comptes = array() ;
        foreach ($categories as $category){
            $documents = $em->getRepository('AppBundle:Document')->findBy(['categorie' => $category]);
            $comptes[$category->getId()] = count($documents);
        }

        return $this->render('AppBundle:Admin:stats.html.twig', array(
           "comptes" => $comptes,
            "categories" => $categories
        ));
    }
}

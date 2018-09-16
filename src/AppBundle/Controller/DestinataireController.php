<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Destinataire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Destinataire controller.
 *
 * @Route("destinataire")
 */
class DestinataireController extends Controller
{
    /**
     * Lists all destinataire entities.
     *
     * @Route("/", name="destinataire_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $destinataires = $em->getRepository('AppBundle:Destinataire')->findAll();

        return $this->render('destinataire/index.html.twig', array(
            'destinataires' => $destinataires,
        ));
    }

    /**
     * Creates a new destinataire entity.
     *
     * @Route("/new", name="destinataire_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $destinataire = new Destinataire();
        $form = $this->createForm('AppBundle\Form\DestinataireType', $destinataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($destinataire);
            $em->flush();

            return $this->redirectToRoute('destinataire_show', array('id' => $destinataire->getId()));
        }

        return $this->render('destinataire/new.html.twig', array(
            'destinataire' => $destinataire,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a destinataire entity.
     *
     * @Route("/{id}", name="destinataire_show")
     * @Method("GET")
     */
    public function showAction(Destinataire $destinataire)
    {
        $deleteForm = $this->createDeleteForm($destinataire);

        return $this->render('destinataire/show.html.twig', array(
            'destinataire' => $destinataire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing destinataire entity.
     *
     * @Route("/{id}/edit", name="destinataire_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Destinataire $destinataire)
    {
        $deleteForm = $this->createDeleteForm($destinataire);
        $editForm = $this->createForm('AppBundle\Form\DestinataireType', $destinataire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('destinataire_edit', array('id' => $destinataire->getId()));
        }

        return $this->render('destinataire/edit.html.twig', array(
            'destinataire' => $destinataire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a destinataire entity.
     *
     * @Route("/{id}", name="destinataire_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Destinataire $destinataire)
    {
        $form = $this->createDeleteForm($destinataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($destinataire);
            $em->flush();
        }

        return $this->redirectToRoute('destinataire_index');
    }

    /**
     * Creates a form to delete a destinataire entity.
     *
     * @param Destinataire $destinataire The destinataire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Destinataire $destinataire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('destinataire_delete', array('id' => $destinataire->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

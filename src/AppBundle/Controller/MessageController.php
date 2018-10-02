<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class MessageController extends Controller
{
    /**
     * @Route("/inbox", name="message_inbox")
     */
    public function inboxAction()
    {
        $provider = $this->get('fos_message.provider');

        $threads = $provider->getInboxThreads();

        return $this->render('AppBundle:Message:inbox.html.twig', array(
            "threads" => $threads
        ));
    }

    /**
     * @Route("/send", name="message_send")
     */
    public function sendAction()
    {

        $provider = $this->get('fos_message.provider');
        $threads = $provider->getSentThreads();
        return $this->render('AppBundle:Message:send.html.twig', array(
            "threads" => $threads
        ));
    }

    /**
     * @Route("/inbox/{id}", name="message_show")
     */
    public function showMessageAction($id) {

        $provider = $this->get('fos_message.provider');

        $thread = $provider->getThread($id);

        $subject  =  $thread->getSubject();


        $body = $thread->getMessages()[0]->getBody();

        return $this->render('AppBundle:Message:show.html.twig', array(
            "thread" => $thread,
            "subject" => $subject,
            "body" => $body
        ));
    }

    /**
     * @Route("/draft", name="message_draft")
     */
    public function draftAction()
    {
        return $this->render('AppBundle:Message:draft.html.twig', array(
            // ...
        ));
    }


    /**
     * @Route("/create", name="message_create")
     * @Method("POST")
     */
    public function createMessageAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $clyde = $em->getRepository('AppBundle:User')->findOneBy(['email' => $request->get('recipient')]) ;

        $composer = $this->get('fos_message.composer');
        $message = $composer->newThread()
            ->setSender($this->getUser())
            ->addRecipient($clyde)
            ->setSubject($request->get('subject'))
            ->setBody($request->get('body'))
            ->getMessage();

        $sender = $this->get('fos_message.sender');
        $sender->send($message);

        // Retrieve flashbag from the controller
        $flashbag = $this->get('session')->getFlashBag();

        // Add flash message
        $flashbag->add("send", "Message envoyé avec succès !");

        return $this->redirectToRoute('message_inbox') ;

    }

    /**
     * @Route("/compose", name="message_compose")
     */
    public function composeAction() {

        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->findAll() ;
        return $this->render('AppBundle:Message:compose.html.twig', array(
            "users" => $users
        ));
    }

    /**
     * @Route("/response", name="message_response")
     * @Method("POST")
     */
    public function responseAction(Request $request) {


        $provider = $this->get('fos_message.provider');

        $thread = $provider->getThread($request->get('thread'));


        $composer = $this->get('fos_message.composer');
        $message = $composer->reply($thread)
            ->setSender($this->getUser())
            ->setBody($request->get('message'))
            ->getMessage();

        $sender = $this->get('fos_message.sender');
        $sender->send($message);

        return $this->redirectToRoute('message_show', array('id' => $request->get('thread')));

    }
}

<?php

namespace Wcs\InfoMailBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Wcs\InfoMailBundle\Entity\InfoMail;
use Wcs\InfoMailBundle\Form\InfoMailType;

/**
 * InfoMail controller.
 *
 */
class InfoMailController extends Controller
{
    /**
     * Lists all InfoMail entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $infoMails = $em->getRepository('WcsInfoMailBundle:InfoMail')->findAll();

        return $this->render('WcsInfoMailBundle:infomail:index.html.twig', array(
            'infoMails' => $infoMails
        ));
    }

    /**
     * @param $id
     *
     * Send mail action
     */
    private function sendMail($id)
    {
        $mail = $this->get('doctrine')->getRepository('WcsInfoMailBundle:InfoMail')->findOneById($id);

        $config = $this->container->getParameter('wcs_info_mail.recipients');

        $user_class = $config['user_class'];
        $mail_field = $config['mail_field'];

        $users = $this->get('doctrine')->getRepository($user_class)->findAll();

        $recipients = [];
        foreach($users as $user)
        {
            if ( $user->$mail_field() != null )
            {
                $recipients[] = $user->$mail_field();
            }
        }

        $sendMessage = \Swift_Message::newInstance()
            ->setSubject($mail->getSubject())
            ->setFrom('no-reply@gmail.com')
            ->setTo($recipients)
            ->setBody(
                $this->renderView(
                    'WcsInfoMailBundle::index.html.twig',
                    array(
                        'mail' => $mail
                    )
                ),
                'text/html'
            );
        $this->get('mailer')->send($sendMessage);
    }

    /**
     * Creates a new InfoMail entity.
     *
     */
    public function newAction(Request $request)
    {
        $infoMail = new InfoMail();
        $form = $this->createForm('Wcs\InfoMailBundle\Form\InfoMailType', $infoMail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($infoMail);
            $em->flush();

            $this->sendMail($infoMail->getId());

            return $this->redirectToRoute('infomail_show', array('id' => $infoMail->getId()));
        }

        return $this->render('WcsInfoMailBundle:infomail:new.html.twig', array(
            'infoMail' => $infoMail,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a InfoMail entity.
     *
     */
    public function showAction(InfoMail $infoMail)
    {
        $deleteForm = $this->createDeleteForm($infoMail);

        return $this->render('WcsInfoMailBundle:infomail:show.html.twig', array(
            'infoMail' => $infoMail,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a InfoMail entity.
     *
     */
    public function deleteAction(Request $request, InfoMail $infoMail)
    {
        $form = $this->createDeleteForm($infoMail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($infoMail);
            $em->flush();
        }

        return $this->redirectToRoute('infomail_index');
    }

    /**
     * Creates a form to delete a InfoMail entity.
     *
     * @param InfoMail $infoMail The InfoMail entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InfoMail $infoMail)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('infomail_delete', array('id' => $infoMail->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

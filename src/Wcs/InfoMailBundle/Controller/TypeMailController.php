<?php

namespace Wcs\InfoMailBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Wcs\InfoMailBundle\Entity\TypeMail;
use Wcs\InfoMailBundle\Form\TypeMailType;

/**
 * TypeMail controller.
 *
 */
class TypeMailController extends Controller
{
    /**
     * Lists all TypeMail entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typeMails = $em->getRepository('WcsInfoMailBundle:TypeMail')->findAll();

        return $this->render('typemail/index.html.twig', array(
            'typeMails' => $typeMails,
        ));
    }

    /**
     * Creates a new TypeMail entity.
     *
     */
    public function newAction(Request $request)
    {
        $typeMail = new TypeMail();
        $form = $this->createForm('Wcs\InfoMailBundle\Form\TypeMailType', $typeMail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeMail);
            $em->flush();

            return $this->redirectToRoute('typemail_show', array('id' => $typeMail->getId()));
        }

        return $this->render('typemail/new.html.twig', array(
            'typeMail' => $typeMail,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TypeMail entity.
     *
     */
    public function showAction(TypeMail $typeMail)
    {
        $deleteForm = $this->createDeleteForm($typeMail);

        return $this->render('typemail/show.html.twig', array(
            'typeMail' => $typeMail,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TypeMail entity.
     *
     */
    public function editAction(Request $request, TypeMail $typeMail)
    {
        $deleteForm = $this->createDeleteForm($typeMail);
        $editForm = $this->createForm('Wcs\InfoMailBundle\Form\TypeMailType', $typeMail);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeMail);
            $em->flush();

            return $this->redirectToRoute('typemail_edit', array('id' => $typeMail->getId()));
        }

        return $this->render('typemail/edit.html.twig', array(
            'typeMail' => $typeMail,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TypeMail entity.
     *
     */
    public function deleteAction(Request $request, TypeMail $typeMail)
    {
        $form = $this->createDeleteForm($typeMail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeMail);
            $em->flush();
        }

        return $this->redirectToRoute('typemail_index');
    }

    /**
     * Creates a form to delete a TypeMail entity.
     *
     * @param TypeMail $typeMail The TypeMail entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TypeMail $typeMail)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typemail_delete', array('id' => $typeMail->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

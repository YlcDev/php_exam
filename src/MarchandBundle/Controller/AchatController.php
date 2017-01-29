<?php

namespace MarchandBundle\Controller;

use MarchandBundle\Entity\Achat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Achat controller.
 *
 */
class AchatController extends Controller
{
    /**
     * Lists all achat entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $achats = $em->getRepository('MarchandBundle:Achat')->findAll();

        return $this->render('MarchandBundle:achat:index.html.twig', array(
            'achats' => $achats,
        ));
    }

    /**
     * Creates a new achat entity.
     *
     */
    public function newAction(Request $request)
    {
        $achat = new Achat();
        $form = $this->createForm('MarchandBundle\Form\AchatType', $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($achat);
            $em->flush($achat);

            return $this->redirectToRoute('achat_show', array('id' => $achat->getId()));
        }

        return $this->render('MarchandBundle:achat:new.html.twig', array(
            'achat' => $achat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a achat entity.
     *
     */
    public function showAction(Achat $achat)
    {
        $deleteForm = $this->createDeleteForm($achat);

        return $this->render('MarchandBundle:achat:show.html.twig', array(
            'achat' => $achat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing achat entity.
     *
     */
    public function editAction(Request $request, Achat $achat)
    {
        $deleteForm = $this->createDeleteForm($achat);
        $editForm = $this->createForm('MarchandBundle\Form\AchatType', $achat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('achat_edit', array('id' => $achat->getId()));
        }

        return $this->render('MarchandBundle:achat:edit.html.twig', array(
            'achat' => $achat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a achat entity.
     *
     */
    public function deleteAction(Request $request, Achat $achat)
    {
        $form = $this->createDeleteForm($achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($achat);
            $em->flush($achat);
        }

        return $this->redirectToRoute('achat_index');
    }

    /**
     * Creates a form to delete a achat entity.
     *
     * @param Achat $achat The achat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Achat $achat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('achat_delete', array('id' => $achat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

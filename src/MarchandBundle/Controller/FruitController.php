<?php

namespace MarchandBundle\Controller;

use MarchandBundle\Entity\Achat;
use MarchandBundle\Entity\Fruit;
use MarchandBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Fruit controller.
 *
 */
class FruitController extends Controller
{
    /**
     * Lists all fruit entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fruits = $em->getRepository('MarchandBundle:Fruit')->findAll();

        return $this->render('MarchandBundle:fruit:index.html.twig', array(
            'fruits' => $fruits,
        ));
    }

    /**
     * Creates a new fruit entity.
     *
     */
    public function newAction(Request $request)
    {
        $fruit = new Fruit();
        $form = $this->createForm('MarchandBundle\Form\FruitType', $fruit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fruit);
            $em->flush($fruit);

            return $this->redirectToRoute('fruit_show', array('id' => $fruit->getId()));
        }

        return $this->render('MarchandBundle:fruit:new.html.twig', array(
            'fruit' => $fruit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a fruit entity.
     *
     */
    public function showAction(Fruit $fruit)
    {
        $deleteForm = $this->createDeleteForm($fruit);

        return $this->render('MarchandBundle:fruit:show.html.twig', array(
            'fruit' => $fruit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fruit entity.
     *
     */
    public function editAction(Request $request, Fruit $fruit)
    {
        $deleteForm = $this->createDeleteForm($fruit);
        $editForm = $this->createForm('MarchandBundle\Form\FruitType', $fruit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fruit_edit', array('id' => $fruit->getId()));
        }

        return $this->render('MarchandBundle:fruit:edit.html.twig', array(
            'fruit' => $fruit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a fruit entity.
     *
     */
    public function deleteAction(Request $request, Fruit $fruit)
    {
        $form = $this->createDeleteForm($fruit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fruit);
            $em->flush($fruit);
        }

        return $this->redirectToRoute('fruit_index');
    }

    /**
     * Creates a form to delete a fruit entity.
     *
     * @param Fruit $fruit The fruit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fruit $fruit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fruit_delete', array('id' => $fruit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

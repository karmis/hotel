<?php

namespace Brainstrap\Bundles\FrontBundle\Controller\Guest;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Brainstrap\Bundles\FrontBundle\Entity\Guest\Guest;
use Brainstrap\Bundles\FrontBundle\Form\Guest\GuestType;

/**
 * Guest\Guest controller.
 *
 */
class GuestController extends Controller
{

    /**
     * Lists all Guest\Guest entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Guest\Guest')->findAll();

        return $this->render('BrainstrapBundlesFrontBundle:Guest/Guest:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Guest\Guest entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Guest();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('guest_guest_show', array('id' => $entity->getId())));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Guest/Guest:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Guest\Guest entity.
     *
     * @param Guest $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Guest $entity)
    {
        $form = $this->createForm(new GuestType(), $entity, array(
            'action' => $this->generateUrl('guest_guest_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Создать'));

        return $form;
    }

    /**
     * Displays a form to create a new Guest\Guest entity.
     *
     */
    public function newAction()
    {
        $entity = new Guest();
        $form   = $this->createCreateForm($entity);

        return $this->render('BrainstrapBundlesFrontBundle:Guest/Guest:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Guest\Guest entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Guest\Guest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Guest\Guest entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Guest/Guest:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Guest\Guest entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Guest\Guest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Guest\Guest entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Guest/Guest:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Guest\Guest entity.
    *
    * @param Guest $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Guest $entity)
    {
        $form = $this->createForm(new GuestType(), $entity, array(
            'action' => $this->generateUrl('guest_guest_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Сохранить изменения'));

        return $form;
    }
    /**
     * Edits an existing Guest\Guest entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Guest\Guest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Guest\Guest entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('guest_guest_edit', array('id' => $id)));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Guest/Guest:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Guest\Guest entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Guest\Guest')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Guest\Guest entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('guest_guest'));
    }

    /**
     * Creates a form to delete a Guest\Guest entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('guest_guest_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm()
        ;
    }
}

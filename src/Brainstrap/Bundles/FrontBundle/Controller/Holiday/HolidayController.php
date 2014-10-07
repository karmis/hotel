<?php

namespace Brainstrap\Bundles\FrontBundle\Controller\Holiday;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Brainstrap\Bundles\FrontBundle\Entity\Holiday\Holiday;
use Brainstrap\Bundles\FrontBundle\Form\Holiday\HolidayType;

/**
 * Holiday\Holiday controller.
 *
 */
class HolidayController extends Controller
{

    /**
     * Lists all Holiday\Holiday entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Holiday\Holiday')->findAll();

        return $this->render('BrainstrapBundlesFrontBundle:Holiday/Holiday:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Holiday\Holiday entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Holiday();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('holiday_holiday_show', array('id' => $entity->getId())));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Holiday/Holiday:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Holiday\Holiday entity.
     *
     * @param Holiday $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Holiday $entity)
    {
        $form = $this->createForm(new HolidayType(), $entity, array(
            'action' => $this->generateUrl('holiday_holiday_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Создать'));

        return $form;
    }

    /**
     * Displays a form to create a new Holiday\Holiday entity.
     *
     */
    public function newAction()
    {
        $entity = new Holiday();
        $form   = $this->createCreateForm($entity);

        return $this->render('BrainstrapBundlesFrontBundle:Holiday/Holiday:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Holiday\Holiday entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Holiday\Holiday')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Holiday\Holiday entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Holiday/Holiday:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Holiday\Holiday entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Holiday\Holiday')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Holiday\Holiday entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Holiday/Holiday:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Holiday\Holiday entity.
    *
    * @param Holiday $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Holiday $entity)
    {
        $form = $this->createForm(new HolidayType(), $entity, array(
            'action' => $this->generateUrl('holiday_holiday_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Сохранить изменения'));

        return $form;
    }
    /**
     * Edits an existing Holiday\Holiday entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Holiday\Holiday')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Holiday\Holiday entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('holiday_holiday_edit', array('id' => $id)));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Holiday/Holiday:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Holiday\Holiday entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Holiday\Holiday')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Holiday\Holiday entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('holiday_holiday'));
    }

    /**
     * Creates a form to delete a Holiday\Holiday entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('holiday_holiday_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm()
        ;
    }
}

<?php

namespace Brainstrap\Bundles\FrontBundle\Controller\Holiday;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Brainstrap\Bundles\FrontBundle\Entity\Holiday\HolidayGallery;
use Brainstrap\Bundles\FrontBundle\Form\Holiday\HolidayGalleryType;

/**
 * Holiday\HolidayGallery controller.
 *
 */
class HolidayGalleryController extends Controller
{

    /**
     * Lists all Holiday\HolidayGallery entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Holiday\HolidayGallery')->findAll();

        return $this->render('BrainstrapBundlesFrontBundle:Holiday/HolidayGallery:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Holiday\HolidayGallery entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new HolidayGallery();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('holiday_holidaygallery_show', array('id' => $entity->getId())));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Holiday/HolidayGallery:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Holiday\HolidayGallery entity.
     *
     * @param HolidayGallery $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(HolidayGallery $entity)
    {
        $form = $this->createForm(new HolidayGalleryType(), $entity, array(
            'action' => $this->generateUrl('holiday_holidaygallery_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Создать'));

        return $form;
    }

    /**
     * Displays a form to create a new Holiday\HolidayGallery entity.
     *
     */
    public function newAction()
    {
        $entity = new HolidayGallery();
        $form   = $this->createCreateForm($entity);

        return $this->render('BrainstrapBundlesFrontBundle:Holiday/HolidayGallery:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Holiday\HolidayGallery entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Holiday\HolidayGallery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Holiday\HolidayGallery entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Holiday/HolidayGallery:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Holiday\HolidayGallery entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Holiday\HolidayGallery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Holiday\HolidayGallery entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Holiday/HolidayGallery:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Holiday\HolidayGallery entity.
    *
    * @param HolidayGallery $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(HolidayGallery $entity)
    {
        $form = $this->createForm(new HolidayGalleryType(), $entity, array(
            'action' => $this->generateUrl('holiday_holidaygallery_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Сохранить изменения'));

        return $form;
    }
    /**
     * Edits an existing Holiday\HolidayGallery entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Holiday\HolidayGallery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Holiday\HolidayGallery entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('holiday_holidaygallery_edit', array('id' => $id)));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Holiday/HolidayGallery:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Holiday\HolidayGallery entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Holiday\HolidayGallery')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Holiday\HolidayGallery entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('holiday_holidaygallery'));
    }

    /**
     * Creates a form to delete a Holiday\HolidayGallery entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('holiday_holidaygallery_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm()
        ;
    }
}

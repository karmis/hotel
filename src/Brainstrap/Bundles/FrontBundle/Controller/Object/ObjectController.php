<?php

namespace Brainstrap\Bundles\FrontBundle\Controller\Object;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Brainstrap\Bundles\FrontBundle\Entity\Object\Object;
use Brainstrap\Bundles\FrontBundle\Form\Object\ObjectType;

use Brainstrap\Bundles\FrontBundle\Form\Object\ObjectFilterAllowedType;

/**
 * Object\Object controller.
 *
 */
class ObjectController extends Controller
{

    /**
     * Lists all Object\Object entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Object\Object')->findAll();
        $form_filter = $this->createFormFilter();

        return $this->render('BrainstrapBundlesFrontBundle:Object/Object:index.html.twig', array(
            'entities' => $entities,
            'form_filter' => $form_filter->createView()
        ));
    }

    /**
     * Creates a new Object\Object entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Object();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('object_object_show', array('id' => $entity->getId())));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Object/Object:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Object\Object entity.
     *
     * @param Object $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Object $entity)
    {
        $form = $this->createForm(new ObjectType(), $entity, array(
            'action' => $this->generateUrl('object_object_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Создать'));

        return $form;
    }

    /**
     * Displays a form to create a new Object\Object entity.
     *
     */
    public function newAction()
    {
        $entity = new Object();
        $form = $this->createCreateForm($entity);

        return $this->render('BrainstrapBundlesFrontBundle:Object/Object:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Object\Object entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\Object')->find($id);
        $booked = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectBooking')->findBy(array(
            'object' => $id,
            'approved' => 1
        ));
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Object\Object entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Object/Object:show.html.twig', array(
            'entity' => $entity,
            'booked' => $booked,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Object\Object entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\Object')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Object\Object entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Object/Object:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Object\Object entity.
     *
     * @param Object $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Object $entity)
    {
        $form = $this->createForm(new ObjectType(), $entity, array(
            'action' => $this->generateUrl('object_object_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Сохранить изменения'));

        return $form;
    }

    /**
     * Edits an existing Object\Object entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\Object')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Object\Object entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('object_object_edit', array('id' => $id)));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Object/Object:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Object\Object entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\Object')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Object\Object entity.');
            }

//            $em->remove($entity);
            $entity->setDeleted(true);

            $em->flush();
        }

        return $this->redirect($this->generateUrl('object_object'));
    }

    /**
     * Creates a form to delete a Object\Object entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('object_object_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить номер'))
            ->getForm();
    }


    private function createFormFilter()
    {
        $form = $this->createForm(new ObjectFilterAllowedType(), null, array(
            'action' => $this->generateUrl('object_object_filter_allowed'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * @param null $type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function filterAction(Request $request)
    {
        $form_filter = $this->createFormFilter();

        if ("POST" == $request->getMethod()) {
            $form_filter->handleRequest($request);
            if ($form_filter->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $startDate = $form_filter->get("startDate")->getData();
                $endDate = $form_filter->get("endDate")->getData();

                $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Object\Object')->filterAllowed($startDate, $endDate);

                return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectBooking:filter.result.html.twig', array(
                    'entities' => $entities,
                    'form_filter' => $form_filter->createView(),
                ));
            }
        }

        return $this->render('BrainstrapBundlesFrontBundle:Object/Object:filter.html.twig', array(
            'form_filter' => $form_filter->createView(),
        ));
    }
}

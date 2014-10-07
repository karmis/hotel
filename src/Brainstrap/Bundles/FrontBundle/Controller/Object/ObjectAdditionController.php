<?php

namespace Brainstrap\Bundles\FrontBundle\Controller\Object;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectAddition;
use Brainstrap\Bundles\FrontBundle\Form\Object\ObjectAdditionType;

/**
 * Object\ObjectAddition controller.
 *
 */
class ObjectAdditionController extends Controller
{

    /**
     * Lists all Object\ObjectAddition entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectAddition')->findAll();

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectAddition:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Object\ObjectAddition entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ObjectAddition();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('object_objectaddition'));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectAddition:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Object\ObjectAddition entity.
     *
     * @param ObjectAddition $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ObjectAddition $entity)
    {
        $form = $this->createForm(new ObjectAdditionType(), $entity, array(
            'action' => $this->generateUrl('object_objectaddition_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Создать'));

        return $form;
    }

    /**
     * Displays a form to create a new Object\ObjectAddition entity.
     *
     */
    public function newAction()
    {
        $entity = new ObjectAddition();
        $form   = $this->createCreateForm($entity);

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectAddition:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Object\ObjectAddition entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectAddition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Object\ObjectAddition entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectAddition:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Object\ObjectAddition entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectAddition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Object\ObjectAddition entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectAddition:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Object\ObjectAddition entity.
    *
    * @param ObjectAddition $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ObjectAddition $entity)
    {
        $form = $this->createForm(new ObjectAdditionType(), $entity, array(
            'action' => $this->generateUrl('object_objectaddition_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Сохранить изменения'));

        return $form;
    }
    /**
     * Edits an existing Object\ObjectAddition entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectAddition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Object\ObjectAddition entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('object_objectaddition_edit', array('id' => $id)));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectAddition:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Object\ObjectAddition entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectAddition')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Object\ObjectAddition entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('object_objectaddition'));
    }

    /**
     * Creates a form to delete a Object\ObjectAddition entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('object_objectaddition_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm()
        ;
    }
}

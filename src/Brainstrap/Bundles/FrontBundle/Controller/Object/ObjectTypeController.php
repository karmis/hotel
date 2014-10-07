<?php

namespace Brainstrap\Bundles\FrontBundle\Controller\Object;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectType;
use Brainstrap\Bundles\FrontBundle\Form\Object\ObjectTypeType;

/**
 * Object\ObjectType controller.
 *
 */
class ObjectTypeController extends Controller
{

    /**
     * Lists all Object\ObjectType entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectType')->findAll();

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectType:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Object\ObjectType entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ObjectType();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('object_objecttype_show', array('id' => $entity->getId())));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Object\ObjectType entity.
     *
     * @param ObjectType $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ObjectType $entity)
    {
        $form = $this->createForm(new ObjectTypeType(), $entity, array(
            'action' => $this->generateUrl('object_objecttype_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Создать'));

        return $form;
    }

    /**
     * Displays a form to create a new Object\ObjectType entity.
     *
     */
    public function newAction()
    {
        $entity = new ObjectType();
        $form   = $this->createCreateForm($entity);

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Object\ObjectType entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Object\ObjectType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectType:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Object\ObjectType entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Object\ObjectType entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Object\ObjectType entity.
    *
    * @param ObjectType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ObjectType $entity)
    {
        $form = $this->createForm(new ObjectTypeType(), $entity, array(
            'action' => $this->generateUrl('object_objecttype_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Сохранить изменения'));

        return $form;
    }
    /**
     * Edits an existing Object\ObjectType entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Object\ObjectType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('object_objecttype_edit', array('id' => $id)));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Object\ObjectType entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Object\ObjectType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('object_objecttype'));
    }

    /**
     * Creates a form to delete a Object\ObjectType entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('object_objecttype_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm()
        ;
    }
}

<?php

namespace Brainstrap\Bundles\FrontBundle\Controller\Object;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectParameter;
use Brainstrap\Bundles\FrontBundle\Form\Object\ObjectParameterType;

/**
 * Object\ObjectParameter controller.
 *
 */
class ObjectParameterController extends Controller
{

    /**
     * Lists all Object\ObjectParameter entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectParameter')->findAll();

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectParameter:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Object\ObjectParameter entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ObjectParameter();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('object_objectparameter_show', array('id' => $entity->getId())));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectParameter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Object\ObjectParameter entity.
     *
     * @param ObjectParameter $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ObjectParameter $entity)
    {
        $form = $this->createForm(new ObjectParameterType(), $entity, array(
            'action' => $this->generateUrl('object_objectparameter_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Создать'));

        return $form;
    }

    /**
     * Displays a form to create a new Object\ObjectParameter entity.
     *
     */
    public function newAction()
    {
        $entity = new ObjectParameter();
        $form   = $this->createCreateForm($entity);

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectParameter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Object\ObjectParameter entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectParameter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Object\ObjectParameter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectParameter:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Object\ObjectParameter entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectParameter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Object\ObjectParameter entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectParameter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Object\ObjectParameter entity.
    *
    * @param ObjectParameter $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ObjectParameter $entity)
    {
        $form = $this->createForm(new ObjectParameterType(), $entity, array(
            'action' => $this->generateUrl('object_objectparameter_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Сохранить изменения'));

        return $form;
    }
    /**
     * Edits an existing Object\ObjectParameter entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectParameter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Object\ObjectParameter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('object_objectparameter_edit', array('id' => $id)));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectParameter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Object\ObjectParameter entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectParameter')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Object\ObjectParameter entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('object_objectparameter'));
    }

    /**
     * Creates a form to delete a Object\ObjectParameter entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('object_objectparameter_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm()
        ;
    }
}

<?php

namespace Brainstrap\Bundles\FrontBundle\Controller\Object;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectService;
use Brainstrap\Bundles\FrontBundle\Form\Object\ObjectServiceType;

/**
 * Object\ObjectService controller.
 *
 */
class ObjectServiceController extends Controller
{

    /**
     * Lists all Object\ObjectService entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectService')->findAll();

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectService:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Object\ObjectService entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ObjectService();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('object_objectservice'));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectService:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Object\ObjectService entity.
     *
     * @param ObjectService $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ObjectService $entity)
    {
        $form = $this->createForm(new ObjectServiceType(), $entity, array(
            'action' => $this->generateUrl('object_objectservice_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Создать'));

        return $form;
    }

    /**
     * Displays a form to create a new Object\ObjectService entity.
     *
     */
    public function newAction()
    {
        $entity = new ObjectService();
        $form   = $this->createCreateForm($entity);

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectService:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Object\ObjectService entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectService')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Object\ObjectService entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectService:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Object\ObjectService entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectService')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Object\ObjectService entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectService:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Object\ObjectService entity.
    *
    * @param ObjectService $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ObjectService $entity)
    {
        $form = $this->createForm(new ObjectServiceType(), $entity, array(
            'action' => $this->generateUrl('object_objectservice_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Сохранить изменения'));

        return $form;
    }
    /**
     * Edits an existing Object\ObjectService entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectService')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Object\ObjectService entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('object_objectservice_edit', array('id' => $id)));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectService:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Object\ObjectService entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectService')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Object\ObjectService entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('object_objectservice'));
    }

    /**
     * Creates a form to delete a Object\ObjectService entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('object_objectservice_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm()
        ;
    }
}

<?php

namespace Brainstrap\Bundles\FrontBundle\Controller\Tariff;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffLateGroup;
use Brainstrap\Bundles\FrontBundle\Form\Tariff\TariffLateGroupType;

/**
 * Tariff\TariffLateGroup controller.
 *
 */
class TariffLateGroupController extends Controller
{

    /**
     * Lists all Tariff\TariffLateGroup entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffLateGroup')->findAll();

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffLateGroup:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Tariff\TariffLateGroup entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TariffLateGroup();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tariff_tarifflategroup'));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffLateGroup:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Tariff\TariffLateGroup entity.
     *
     * @param TariffLateGroup $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TariffLateGroup $entity)
    {
        $form = $this->createForm(new TariffLateGroupType(), $entity, array(
            'action' => $this->generateUrl('tariff_tarifflategroup_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Создать'));

        return $form;
    }

    /**
     * Displays a form to create a new Tariff\TariffLateGroup entity.
     *
     */
    public function newAction()
    {
        $entity = new TariffLateGroup();
        $form   = $this->createCreateForm($entity);

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffLateGroup:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tariff\TariffLateGroup entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffLateGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tariff\TariffLateGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffLateGroup:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tariff\TariffLateGroup entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffLateGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tariff\TariffLateGroup entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffLateGroup:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Tariff\TariffLateGroup entity.
    *
    * @param TariffLateGroup $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TariffLateGroup $entity)
    {
        $form = $this->createForm(new TariffLateGroupType(), $entity, array(
            'action' => $this->generateUrl('tariff_tarifflategroup_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Сохранить изменения'));

        return $form;
    }
    /**
     * Edits an existing Tariff\TariffLateGroup entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffLateGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tariff\TariffLateGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tariff_tarifflategroup_edit', array('id' => $id)));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffLateGroup:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Tariff\TariffLateGroup entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffLateGroup')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tariff\TariffLateGroup entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tariff_tarifflategroup'));
    }

    /**
     * Creates a form to delete a Tariff\TariffLateGroup entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tariff_tarifflategroup_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm()
        ;
    }
}

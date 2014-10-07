<?php

namespace Brainstrap\Bundles\FrontBundle\Controller\Tariff;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffLate;
use Brainstrap\Bundles\FrontBundle\Form\Tariff\TariffLateType;

/**
 * Tariff\TariffLate controller.
 *
 */
class TariffLateController extends Controller
{

    /**
     * Lists all Tariff\TariffLate entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffLate')->findAll();

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffLate:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Tariff\TariffLate entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TariffLate();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tariff_tarifflate'));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffLate:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Tariff\TariffLate entity.
     *
     * @param TariffLate $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TariffLate $entity)
    {
        $form = $this->createForm(new TariffLateType(), $entity, array(
            'action' => $this->generateUrl('tariff_tarifflate_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Создать'));

        return $form;
    }

    /**
     * Displays a form to create a new Tariff\TariffLate entity.
     *
     */
    public function newAction()
    {
        $entity = new TariffLate();
        $form   = $this->createCreateForm($entity);

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffLate:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tariff\TariffLate entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffLate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tariff\TariffLate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffLate:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tariff\TariffLate entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffLate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tariff\TariffLate entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffLate:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Tariff\TariffLate entity.
    *
    * @param TariffLate $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TariffLate $entity)
    {
        $form = $this->createForm(new TariffLateType(), $entity, array(
            'action' => $this->generateUrl('tariff_tarifflate_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Сохранить изменения'));

        return $form;
    }
    /**
     * Edits an existing Tariff\TariffLate entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffLate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tariff\TariffLate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tariff_tarifflate_edit', array('id' => $id)));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffLate:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Tariff\TariffLate entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffLate')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tariff\TariffLate entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tariff_tarifflate'));
    }

    /**
     * Creates a form to delete a Tariff\TariffLate entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tariff_tarifflate_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm()
        ;
    }
}

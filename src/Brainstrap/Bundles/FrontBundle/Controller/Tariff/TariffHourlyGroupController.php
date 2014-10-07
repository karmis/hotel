<?php

namespace Brainstrap\Bundles\FrontBundle\Controller\Tariff;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffHourlyGroup;
use Brainstrap\Bundles\FrontBundle\Form\Tariff\TariffHourlyGroupType;

/**
 * Tariff\TariffHourlyGroup controller.
 *
 */
class TariffHourlyGroupController extends Controller
{

    /**
     * Lists all Tariff\TariffHourlyGroup entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffHourlyGroup')->findAll();

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffHourlyGroup:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Tariff\TariffHourlyGroup entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TariffHourlyGroup();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tariff_tariffhourlygroup'));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffHourlyGroup:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Tariff\TariffHourlyGroup entity.
     *
     * @param TariffHourlyGroup $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TariffHourlyGroup $entity)
    {
        $form = $this->createForm(new TariffHourlyGroupType(), $entity, array(
            'action' => $this->generateUrl('tariff_tariffhourlygroup_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Создать'));

        return $form;
    }

    /**
     * Displays a form to create a new Tariff\TariffHourlyGroup entity.
     *
     */
    public function newAction()
    {
        $entity = new TariffHourlyGroup();
        $form   = $this->createCreateForm($entity);

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffHourlyGroup:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tariff\TariffHourlyGroup entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffHourlyGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tariff\TariffHourlyGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffHourlyGroup:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tariff\TariffHourlyGroup entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffHourlyGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tariff\TariffHourlyGroup entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffHourlyGroup:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Tariff\TariffHourlyGroup entity.
    *
    * @param TariffHourlyGroup $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TariffHourlyGroup $entity)
    {
        $form = $this->createForm(new TariffHourlyGroupType(), $entity, array(
            'action' => $this->generateUrl('tariff_tariffhourlygroup_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Сохранить изменения'));

        return $form;
    }
    /**
     * Edits an existing Tariff\TariffHourlyGroup entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffHourlyGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tariff\TariffHourlyGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tariff_tariffhourlygroup_edit', array('id' => $id)));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffHourlyGroup:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Tariff\TariffHourlyGroup entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffHourlyGroup')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tariff\TariffHourlyGroup entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tariff_tariffhourlygroup'));
    }

    /**
     * Creates a form to delete a Tariff\TariffHourlyGroup entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tariff_tariffhourlygroup_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm()
        ;
    }
}

<?php

namespace Brainstrap\Bundles\FrontBundle\Controller\Tariff;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffHourly;
use Brainstrap\Bundles\FrontBundle\Form\Tariff\TariffHourlyType;

/**
 * Tariff\TariffHourly controller.
 *
 */
class TariffHourlyController extends Controller
{

    /**
     * Lists all Tariff\TariffHourly entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffHourly')->findAll();

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffHourly:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Tariff\TariffHourly entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TariffHourly();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tariff_tariffhourly'));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffHourly:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Tariff\TariffHourly entity.
     *
     * @param TariffHourly $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TariffHourly $entity)
    {
        $form = $this->createForm(new TariffHourlyType(), $entity, array(
            'action' => $this->generateUrl('tariff_tariffhourly_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Создать'));

        return $form;
    }

    /**
     * Displays a form to create a new Tariff\TariffHourly entity.
     *
     */
    public function newAction()
    {
        $entity = new TariffHourly();
        $form   = $this->createCreateForm($entity);

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffHourly:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tariff\TariffHourly entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffHourly')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tariff\TariffHourly entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffHourly:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tariff\TariffHourly entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffHourly')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tariff\TariffHourly entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffHourly:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Tariff\TariffHourly entity.
    *
    * @param TariffHourly $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TariffHourly $entity)
    {
        $form = $this->createForm(new TariffHourlyType(), $entity, array(
            'action' => $this->generateUrl('tariff_tariffhourly_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Сохранить изменения'));

        return $form;
    }
    /**
     * Edits an existing Tariff\TariffHourly entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffHourly')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tariff\TariffHourly entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tariff_tariffhourly_edit', array('id' => $id)));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/TariffHourly:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Tariff\TariffHourly entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\TariffHourly')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tariff\TariffHourly entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tariff_tariffhourly'));
    }

    /**
     * Creates a form to delete a Tariff\TariffHourly entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tariff_tariffhourly_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm()
        ;
    }
}

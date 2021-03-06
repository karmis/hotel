<?php

namespace Brainstrap\Bundles\FrontBundle\Controller\Tariff;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Brainstrap\Bundles\FrontBundle\Entity\Tariff\Tariff;
use Brainstrap\Bundles\FrontBundle\Form\Tariff\TariffType;

/**
 * Tariff\Tariff controller.
 *
 */
class TariffController extends Controller
{

    /**
     * Lists all Tariff\Tariff entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\Tariff')->findAll();

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/Tariff:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Tariff\Tariff entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Tariff();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tariff_tariff'));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/Tariff:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Tariff\Tariff entity.
     *
     * @param Tariff $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Tariff $entity)
    {
        $form = $this->createForm(new TariffType(), $entity, array(
            'action' => $this->generateUrl('tariff_tariff_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Создать'));

        return $form;
    }

    /**
     * Displays a form to create a new Tariff\Tariff entity.
     *
     */
    public function newAction()
    {
        $entity = new Tariff();
        $form   = $this->createCreateForm($entity);

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/Tariff:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tariff\Tariff entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\Tariff')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tariff\Tariff entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/Tariff:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tariff\Tariff entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\Tariff')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tariff\Tariff entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/Tariff:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Tariff\Tariff entity.
    *
    * @param Tariff $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tariff $entity)
    {
        $form = $this->createForm(new TariffType(), $entity, array(
            'action' => $this->generateUrl('tariff_tariff_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Сохранить изменения'));

        return $form;
    }
    /**
     * Edits an existing Tariff\Tariff entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\Tariff')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tariff\Tariff entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tariff_tariff_edit', array('id' => $id)));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Tariff/Tariff:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Tariff\Tariff entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Tariff\Tariff')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tariff\Tariff entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tariff_tariff'));
    }

    /**
     * Creates a form to delete a Tariff\Tariff entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tariff_tariff_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm()
        ;
    }
}

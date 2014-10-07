<?php

namespace Brainstrap\Bundles\FrontBundle\Controller\Review;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Brainstrap\Bundles\FrontBundle\Entity\Review\Review;
use Brainstrap\Bundles\FrontBundle\Form\Review\ReviewType;

/**
 * Review\Review controller.
 *
 */
class ReviewController extends Controller
{

    /**
     * Lists all Review\Review entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Review\Review')->findBy(array(
            'deleted' => 0
        ), array('date' => 'DESC'));

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1) /*page number*/,
            30/*limit per page*/
        );

        // parameters to template
        return $this->render('BrainstrapBundlesFrontBundle:Review/Review:index.html.twig', array(
            'pagination' => $pagination,
        ));

    }

    /**
     * Creates a new Review\Review entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Review();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                'Благодарим Вас за оставленный отзыв!'
            );

        } else {
            $this->get('session')->getFlashBag()->add(
                'attention',
                'Проверьте поля. Возможно неверно введены символы в captcha'
            );
        }

        return $this->redirect($this->generateUrl('review_review', array('id' => $entity->getId())));
    }

    /**
     * Creates a form to create a Review\Review entity.
     *
     * @param Review $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Review $entity)
    {
        $form = $this->createForm(new ReviewType(), $entity, array(
            'action' => $this->generateUrl('review_review_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Добавить отзыв'));

        return $form;
    }

    /**
     * Displays a form to create a new Review\Review entity.
     *
     */
    public function newAction()
    {
        $entity = new Review();
        $form = $this->createCreateForm($entity);

        return $this->render('BrainstrapBundlesFrontBundle:Review/Review:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Review\Review entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Review\Review')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Review\Review entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Review/Review:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Review\Review entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Review\Review')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Review\Review entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Review/Review:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Review\Review entity.
     *
     * @param Review $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Review $entity)
    {
        $form = $this->createForm(new ReviewType('edit'), $entity, array(
            'action' => $this->generateUrl('review_review_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Сохранить изменения'));

        return $form;
    }

    /**
     * Edits an existing Review\Review entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Review\Review')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Review\Review entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('review_review_edit', array('id' => $id)));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Review/Review:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Review\Review entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Review\Review')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Review\Review entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('review_review'));
    }

    /**
     * Creates a form to delete a Review\Review entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('review_review_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm();
    }
}

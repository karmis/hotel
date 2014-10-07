<?php

namespace Brainstrap\Bundles\FrontBundle\Controller\Object;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectBooking;
use Brainstrap\Bundles\FrontBundle\Form\Object\ObjectBookingType;

/**
 * Object\ObjectBooking controller.
 *
 */
class ObjectBookingController extends Controller
{

    /**
     * Lists all Object\ObjectBooking entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectBooking')->createQueryBuilder('ob')
            ->innerJoin("ob.object", "object")
            ->where('object.deleted = :no')
            ->andWhere('ob.deleted = :no')
            ->setParameter('no', 0)
            ->getQuery()->getResult();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1) /*page number*/,
            25/*limit per page*/
        );

//        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectBooking')->findAll();

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectBooking:index.html.twig', array(
            'entities' => $pagination,
        ));
    }

    /**
     * Creates a new Object\ObjectBooking entity.
     *
     */
    public function createAction(Request $request, $type = 'admin')
    {
        $entity = new ObjectBooking();
        $form = $this->createCreateForm($entity, $type, null);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entityId = $form->get('entityId')->getData();

            $startDate = $form->get("startDate")->getData();
            $endDate = $form->get("endDate")->getData();
            $booked = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectBooking')->filterAllowedById($entityId, $startDate, $endDate);

            if (count($booked) == 0) {
                $objectEntity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\Object')->find($entityId);

                if (!$objectEntity) {
                    throw $this->createNotFoundException('Unable to find Object\Object entity.');
                }

                $entity->setObject($objectEntity);
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('object_objectbooking_complete'));
            } else {
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'busy'
                );

                return $this->redirect($this->generateUrl('object_object_show', array('id' => $entityId)));
            }
        }

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectBooking:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Object\ObjectBooking entity.
     *
     * @param ObjectBooking $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ObjectBooking $entity, $type, $entityId)
    {
        $form = $this->createForm(new ObjectBookingType('client', $entityId), $entity, array(
            'action' => $this->generateUrl('object_objectbooking_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Бронировать'));

        return $form;
    }

    /**
     * Displays a form to create a new Object\ObjectBooking entity.
     *
     */
    public function newAction($type = 'client', $entityId)
    {
        $entity = new ObjectBooking();
        $form = $this->createCreateForm($entity, $type, $entityId);

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectBooking:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
            'entityId' => $entityId
        ));
    }

    /**
     * Finds and displays a Object\ObjectBooking entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectBooking')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Object\ObjectBooking entity.');
        }
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectBooking:show.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Object\ObjectBooking entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectBooking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Object\ObjectBooking entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectBooking:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Object\ObjectBooking entity.
     *
     * @param ObjectBooking $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ObjectBooking $entity)
    {
        $form = $this->createForm(new ObjectBookingType('admin'), $entity, array(
            'action' => $this->generateUrl('object_objectbooking_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Сохранить изменения'));

        return $form;
    }

    /**
     * Edits an existing Object\ObjectBooking entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectBooking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Object\ObjectBooking entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            $booked = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectBooking')->filterAllowedById($entity->getObject()->getId(), $entity->getStartDate(), $entity->getEndDate());;
            $cBooked = count($booked);
            if ($cBooked == 0) {
                $em->flush();

                if ($entity->getApproved() == 1)
                {
                    $this->get('session')->getFlashBag()->add(
                        'success',
                        'Успешно'
                    );

                    $subject = 'Заявка на бронирвоание одобрена';
                    $tpl = 'approved';

                    $fromEmail = $this->container->getParameter('send_email_from');
                    $toEmail = $entity->getEmail();
                    $message = \Swift_Message::newInstance()
                        ->setSubject($subject)
                        ->setFrom($fromEmail)
                        ->setTo($toEmail)
                        ->setBody(
                            $this->renderView(
                                'BrainstrapBundlesFrontBundle:Email:' . $tpl . '.html.twig',
                                array('entity' => $entity)
                            ), 'text/html'
                        );
                    $this->get('mailer')->send($message);
                } else {
                    $this->get('session')->getFlashBag()->add(
                        'removed',
                        'Одобрение не получено'
                    );
                }

            } else {

                if($cBooked == 1) {
                    $bEntity = $booked[0];
                    if($bEntity->getObject()->getId() == $entity->getObject()->getId()){
                        $this->get('session')->getFlashBag()->add(
                            'removed',
                            'Одобрение не получено'
                        );
                        $em->flush();
                    }
                } else {
                    $this->get('session')->getFlashBag()->add(
                        'notice',
                        'Номер заблокирован'
                    );
                }

            }

            return $this->redirect($this->generateUrl('object_objectbooking_show', array('id' => $id)));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectBooking:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Object\ObjectBooking entity.
     *
     */
    public
    function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectBooking')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Object\ObjectBooking entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('object_objectbooking'));
    }

    /**
     * Creates a form to delete a Object\ObjectBooking entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private
    function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('object_objectbooking_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public
    function completeAction()
    {
        return $this->render('BrainstrapBundlesFrontBundle:Object/ObjectBooking:complete.html.twig');
    }
}

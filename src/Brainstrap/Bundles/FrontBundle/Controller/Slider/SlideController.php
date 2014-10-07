<?php

namespace Brainstrap\Bundles\FrontBundle\Controller\Slider;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Brainstrap\Bundles\FrontBundle\Entity\Slider\Slide;
use Brainstrap\Bundles\FrontBundle\Form\Slider\SlideType;

/**
 * Slider\Slide controller.
 *
 */
class SlideController extends Controller
{

    /**
     * Lists all Slider\Slide entities.
     *
     */
    public function indexAction($type = null)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = array();
        $template = 'index';
        if ($type !== null) {
            if ($type == 'main') {

                $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Slider\Slide')->createQueryBuilder('slide')
                    ->where('slide.forMain = :is')
                    ->setParameter('is', 1)
                    ->getQuery()->getResult();

                $template = "main";
            }

            if ($type == 'gallery') {
                $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Slider\Slide')->createQueryBuilder('slide')
                    ->where('slide.forGallery = :is')
                    ->setParameter('is', 1)
                    ->getQuery()->getResult();

                $template = "gallery";
            }
        } else {
            $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Slider\Slide')->findAll();
            $template = "index";
        }


        return $this->render('BrainstrapBundlesFrontBundle:Slider/Slide:'.$template.'.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Slider\Slide entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Slide();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('slider_slide_show', array('id' => $entity->getId())));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Slider/Slide:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Slider\Slide entity.
     *
     * @param Slide $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Slide $entity)
    {
        $form = $this->createForm(new SlideType(), $entity, array(
            'action' => $this->generateUrl('slider_slide_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Создать'));

        return $form;
    }

    /**
     * Displays a form to create a new Slider\Slide entity.
     *
     */
    public function newAction()
    {
        $entity = new Slide();
        $form = $this->createCreateForm($entity);

        return $this->render('BrainstrapBundlesFrontBundle:Slider/Slide:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Slider\Slide entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Slider\Slide')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Slider\Slide entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Slider/Slide:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Slider\Slide entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Slider\Slide')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Slider\Slide entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:Slider/Slide:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Slider\Slide entity.
     *
     * @param Slide $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Slide $entity)
    {
        $form = $this->createForm(new SlideType(), $entity, array(
            'action' => $this->generateUrl('slider_slide_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Сохранить изменения'));

        return $form;
    }

    /**
     * Edits an existing Slider\Slide entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Slider\Slide')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Slider\Slide entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('slider_slide_edit', array('id' => $id)));
        }

        return $this->render('BrainstrapBundlesFrontBundle:Slider/Slide:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Slider\Slide entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrainstrapBundlesFrontBundle:Slider\Slide')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Slider\Slide entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('slider_slide'));
    }

    /**
     * Creates a form to delete a Slider\Slide entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('slider_slide_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm();
    }
}

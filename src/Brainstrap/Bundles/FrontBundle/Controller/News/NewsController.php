<?php

namespace Brainstrap\Bundles\FrontBundle\Controller\News;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Brainstrap\Bundles\FrontBundle\Entity\News\News;
use Brainstrap\Bundles\FrontBundle\Form\News\NewsType;

/**
 * News\News controller.
 *
 */
class NewsController extends Controller
{

    /**
     * Lists all News\News entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:News\News')->findAll();

        return $this->render('BrainstrapBundlesFrontBundle:News/News:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new News\News entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new News();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('news_news_show', array('id' => $entity->getId())));
        }

        return $this->render('BrainstrapBundlesFrontBundle:News/News:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a News\News entity.
     *
     * @param News $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(News $entity)
    {
        $form = $this->createForm(new NewsType(), $entity, array(
            'action' => $this->generateUrl('news_news_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Создать'));

        return $form;
    }

    /**
     * Displays a form to create a new News\News entity.
     *
     */
    public function newAction()
    {
        $entity = new News();
        $form   = $this->createCreateForm($entity);

        return $this->render('BrainstrapBundlesFrontBundle:News/News:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a News\News entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:News\News')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find News\News entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:News/News:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing News\News entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:News\News')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find News\News entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BrainstrapBundlesFrontBundle:News/News:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a News\News entity.
    *
    * @param News $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(News $entity)
    {
        $form = $this->createForm(new NewsType(), $entity, array(
            'action' => $this->generateUrl('news_news_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Сохранить изменения'));

        return $form;
    }
    /**
     * Edits an existing News\News entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BrainstrapBundlesFrontBundle:News\News')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find News\News entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('news_news_edit', array('id' => $id)));
        }

        return $this->render('BrainstrapBundlesFrontBundle:News/News:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a News\News entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BrainstrapBundlesFrontBundle:News\News')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find News\News entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('news_news'));
    }

    /**
     * Creates a form to delete a News\News entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('news_news_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm()
        ;
    }
}

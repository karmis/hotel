<?php
/**
 * Created by PhpStorm.
 * User: karmis
 * Date: 10.09.14
 * Time: 16:00
 */

namespace Brainstrap\Bundles\FrontBundle\Controller\Gallery;

use Brainstrap\Bundles\FrontBundle\Form\Feedback\FeedbackType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GalleryController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Slider\Slide')->createQueryBuilder('s')
            ->where('s.forGallery = :is')
            ->setParameter('is', 1)
            ->getQuery()->getResult();

        return $this->render('BrainstrapBundlesFrontBundle:Gallery:index.html.twig', array(
            'entities' => $entities
        ));
    }
}

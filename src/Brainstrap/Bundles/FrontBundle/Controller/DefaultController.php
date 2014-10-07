<?php

namespace Brainstrap\Bundles\FrontBundle\Controller;

use Brainstrap\Bundles\FrontBundle\Form\Feedback\FeedbackType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
//        $em = $this->getDoctrine()->getManager();
//        $prObjects = $em->getRepository('BrainstrapBundlesFrontBundle:Object\Object')->createQueryBuilder('object')
//            ->where('object.recommended = :is')
//            ->setParameter('is', 1)
//            ->orderBy('object.recommended', 'ASC')
//            ->setMaxResults(3)
//            ->getQuery()->getResult();

        return $this->render('BrainstrapBundlesFrontBundle:Default:index.html.twig', array( //            'prObjects' => $prObjects
        ));
    }

    public function feedbackAction(Request $request)
    {
        $form = $this->createForm(new FeedbackType(), array(
            'action' => $this->generateUrl('brainstrap_bundles_front_feedback'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Отправить'));


        if ("POST" == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $subject = 'Сообщение из формы обратной связи';
                $quest = $request->request;
                $fromEmail = $this->container->getParameter('send_email_from');
                $toEmail = $fromEmail = $this->container->getParameter('send_email_admin');
                $message = \Swift_Message::newInstance()
                    ->setSubject($subject)
                    ->setFrom($fromEmail)
                    ->setTo($toEmail)
                    ->setBody(
                        $this->renderView(
                            'BrainstrapBundlesFrontBundle:Email:feedback.html.twig',
                            array(
                                'caption' => $quest->get('caption'),
                                'phone' => $quest->get('phone'),
                                'email' => $quest->get('email'),
                                'description' => $quest->get('description'),
                            )
                        ), 'text/html'
                    );
                $this->get('mailer')->send($message);

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'Собщение успешно отправлено'
                );
            } else {
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Собщение не отправлено'
                );
            }
        }

        return $this->render('BrainstrapBundlesFrontBundle:Default:feedback.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

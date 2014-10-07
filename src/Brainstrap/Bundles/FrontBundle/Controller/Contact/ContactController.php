<?php
/**
 * Created by PhpStorm.
 * User: karmis
 * Date: 04.09.14
 * Time: 19:02
 */

namespace Brainstrap\Bundles\FrontBundle\Controller\Contact;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller {

    public function indexAction()
    {
        return $this->render('BrainstrapBundlesFrontBundle:Contact:contact.html.twig');
    }

} 
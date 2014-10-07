<?php
/**
 * Created by PhpStorm.
 * User: karmis
 * Date: 10.09.14
 * Time: 5:54
 */
namespace Brainstrap\Bundles\FrontBundle\Form\Feedback;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FeedbackType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('caption', 'text', array(
                'required' => true,
                'mapped' => false
            ))
            ->add('phone', 'text', array(
                'required' => true,
                'mapped' => false
            ))
            ->add('email', 'email', array(
                'required' => false,
                'mapped' => false
            ))
            ->add('description', 'textarea', array(
                'required' => true,
                'mapped' => false
            ))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'brainstrap_bundles_frontbundle_default_feedback';
    }
}

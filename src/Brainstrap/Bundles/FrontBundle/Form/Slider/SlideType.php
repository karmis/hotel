<?php

namespace Brainstrap\Bundles\FrontBundle\Form\Slider;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SlideType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('caption')
            ->add('secondCaption')
            ->add('description')
            ->add('colorCaption')
            ->add('colorSecondCaption')
            ->add('colorDescription')
            ->add('photo', 'file', array(
                'data_class' => null,
                'required' => false
            ))
            ->add('forMain', null, array(
                'label' => 'Публиковать на главной'
            ))
            ->add('forGallery', null, array(
                'label' => 'Публиковать в галлерее'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Brainstrap\Bundles\FrontBundle\Entity\Slider\Slide'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'brainstrap_bundles_frontbundle_slider_slide';
    }
}

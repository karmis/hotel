<?php

namespace Brainstrap\Bundles\FrontBundle\Form\Object;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ObjectGalleryType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('caption')
            ->add('photo', 'file', array(
                'data_class' => null
            ))
            ->add('description', null, array(
                'required' => false
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectGallery'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'brainstrap_bundles_frontbundle_object_objectgallery';
    }
}

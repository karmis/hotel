<?php

namespace Brainstrap\Bundles\FrontBundle\Form\Holiday;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HolidayType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('caption')
            ->add('description')
            ->add('avatar', 'file', array(
                'data_class' => null,
                'required' => false
            ))
            ->add(
                'gallery',
                'collection',
                array(
                    'type' => new HolidayGalleryType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'required' => false,
                    'by_reference' => false,
                    'attr' => array('class' => 'gallery_item'),
                    'label' => ''
                )
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Brainstrap\Bundles\FrontBundle\Entity\Holiday\Holiday'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'brainstrap_bundles_frontbundle_holiday_holiday';
    }
}

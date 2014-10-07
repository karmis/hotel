<?php

namespace Brainstrap\Bundles\FrontBundle\Form\Tariff;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TariffType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('caption')
            ->add('countPeople')
            ->add('description')
            ->add('price')
            ->add('group', null, array(
                'empty_value' => false,
            ))
            ->add('type', null, array(
                'empty_value' => false,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Brainstrap\Bundles\FrontBundle\Entity\Tariff\Tariff'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'brainstrap_bundles_frontbundle_tariff_tariff';
    }
}

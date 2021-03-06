<?php

namespace Brainstrap\Bundles\FrontBundle\Form\Tariff;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TariffHourlyType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('caption')
            ->add('priceFirstHourly')
            ->add('priceNextHourly')
            ->add('group')
            ->add('type')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Brainstrap\Bundles\FrontBundle\Entity\Tariff\TariffHourly'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'brainstrap_bundles_frontbundle_tariff_tariffhourly';
    }
}

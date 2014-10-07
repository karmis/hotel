<?php
/**
 * Created by PhpStorm.
 * User: karmis
 * Date: 04.09.14
 * Time: 18:27
 */

namespace Brainstrap\Bundles\FrontBundle\Form\Object;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ObjectFilterAllowedType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
            ))
            ->add('endDate', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
            ))
            ->add('submit', 'submit', array(
                'label' => 'Подобрать',
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectBooking'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'brainstrap_bundles_frontbundle_object_objectbookingfilter';
    }
} 
<?php

namespace Brainstrap\Bundles\FrontBundle\Form\Object;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ObjectBookingType extends AbstractType
{
    private $type;
    private $entityId;

    public function __construct($type, $entityId = null)
    {
        $this->type = $type;
        $this->entityId = $entityId;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        if ($this->type == 'admin') {
            $builder->add('approved');
        } else {
            $builder
                ->add('name')
                ->add('sname')
                ->add('countAdult')
                ->add('countChild')
                ->add('phone')
                ->add('email', 'email')
                ->add('startDate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                ))
                ->add('endDate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                ));
            if ($this->entityId == null) {
                $hiddenParams = array(
                    'mapped' => false
                );
            } else {
                $hiddenParams = array(
                    'data' => $this->entityId,
                    'mapped' => false
                );
            }

            $builder->add('entityId', 'hidden', $hiddenParams);

        }


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
        return 'brainstrap_bundles_frontbundle_object_objectbooking';
    }
}

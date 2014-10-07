<?php

namespace Brainstrap\Bundles\FrontBundle\Form\Object;

use Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectGallery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ObjectType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('recommended', null, array(
                'label' => 'Показать на главной'
            ))
            ->add('caption')
            ->add('description')
            ->add('tariffWeekly', null, array(
                'empty_value' => "Выберете тариф",
                'empty_data' => null,
                'required' => true,
                'class' => 'BrainstrapBundlesFrontBundle:Tariff\TariffGroup',
                'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('t')
                            ->orderBy('t.caption', 'ASC');
                    },
            ))
            ->add('tariffHoliday', null, array(
                'empty_value' => "Выберете тариф",
                'empty_data' => null,
                'required' => true,
                'class' => 'BrainstrapBundlesFrontBundle:Tariff\TariffGroup',
                'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('t')
                            ->orderBy('t.caption', 'ASC');
                    },
            ))
            ->add('tariffLate', null, array(
                'empty_value' => "Выберете тариф",
                'empty_data' => null,
                'required' => true,
                'class' => 'BrainstrapBundlesFrontBundle:Tariff\TariffLateGroup',
                'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('tl')
//                            ->where('tl.group')
                            ->orderBy('tl.caption', 'ASC');
                    },
            ))
            ->add('tariffWeekend', null, array(
                'empty_value' => "Выберете тариф",
                'empty_data' => null,
                'required' => true,
                'class' => 'BrainstrapBundlesFrontBundle:Tariff\TariffGroup',
                'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('t')
                            ->orderBy('t.caption', 'ASC');
                    },
            ))
            ->add('tariffHourly', null, array(
                'empty_value' => "Выберете тариф",
                'empty_data' => null,
                'required' => true,
                'class' => 'BrainstrapBundlesFrontBundle:Tariff\TariffHourlyGroup',
                'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('t')
                            ->orderBy('t.caption', 'ASC');
                    },
            ))
            ->add('avatar', 'file', array(
                'data_class' => null,
                'required' => false
            ))
            ->add(
                'gallery',
                'collection',
                array(
                    'type' => new ObjectGalleryType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'required' => false,
                    'by_reference' => false,
                    'attr' => array('class' => 'gallery_item'),
                    'label' => ''
                )
            )
            ->add('type', null, array(
                    'empty_value' => "Тип номера",
                    'empty_data' => null,
                'required' => true,
                ))
            ->add('berth', null, array(
                'empty_value' => "Спальных мест",
                'empty_data' => null,
                'required' => true,
            ))
            ->add('additions','entity', array(
                'empty_value' => false,
                'class' => "Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectAddition",
                'expanded' => true,
                'multiple' => true,
                'attr' => array(
                    'class' => 'input-checkbox validate-addition'
                )
            ))
            ->add('services','entity', array(
                'class' => "Brainstrap\Bundles\FrontBundle\Entity\Object\ObjectService",
                'expanded' => true,
                'multiple' => true
            ))

            ->add(
                'parameters',
                'collection',
                array(
                    'type' => new ObjectParameterType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'required' => false,
                    'by_reference' => false,
                    'attr' => array('class' => 'parameter_item'),
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
            'data_class' => 'Brainstrap\Bundles\FrontBundle\Entity\Object\Object'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'brainstrap_bundles_frontbundle_object_object';
    }
}

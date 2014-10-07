<?php

namespace Brainstrap\Bundles\FrontBundle\Form\Review;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReviewType extends AbstractType
{
    private $type;

    public function __construct($type = 'new')
    {
        $this->type = $type;
    }
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
        ;

        if($this->type == 'edit')
        {
            $builder->add('deleted', null, array(
                'label' => 'Снять с публикации'
            ));
        }
        else
        {
            $builder->add('captcha', 'captcha', array(
                'label' => 'Введите символы с картинки'
            ));
        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Brainstrap\Bundles\FrontBundle\Entity\Review\Review'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'brainstrap_bundles_frontbundle_review_review';
    }
}

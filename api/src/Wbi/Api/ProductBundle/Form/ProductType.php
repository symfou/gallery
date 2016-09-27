<?php

namespace Wbi\Api\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ProductType
 * @package Wbi\Api\ProductBundle\Form
 */
class ProductType extends AbstractType
{
    protected $entity_class;

    public function __construct($entity_class)
    {
        $this->entity_class = $entity_class;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('image')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->entity_class,
        ));
    }

    public function getName()
    {
        return 'product_type';
    }
}

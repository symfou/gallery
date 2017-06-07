<?php

namespace Wbi\Api\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class ProductInfoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', null, array(
                'constraints' => array(
                    new NotBlank()
                )
            ))
            ->add('price')
            ->add('vat_rate')
            ->add('stock')
//            ->add('createdAt', 'datetime')
//            ->add('updatedAt', 'datetime')
//            ->add('product')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Wbi\Api\ProductBundle\Entity\ProductInfo'
        ));
    }

    public function getName()
    {
        return 'product_info_type';
    }
}

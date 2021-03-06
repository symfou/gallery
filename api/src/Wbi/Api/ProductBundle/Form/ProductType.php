<?php

namespace Wbi\Api\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

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
            ->add('name', null, array(
                'constraints' => array(
                    new NotBlank()
                )
            ))
            ->add('slug')
            ->add('short_description', null, array(
                'constraints' => array(
                    new NotBlank()
                )
            ))
            
            ->add('code', null, array(
                'constraints' => array(
                    new NotBlank()
                )
            ))
            ->add('available_on', 'datetime')
            ->add('available_until', 'datetime')
            
            ->add('is_enabled', null, array(
                'constraints' => array(
//                    new NotBlank()
                )
            ))
            ->add('is_published', null, array(
                'constraints' => array(
//                    new NotBlank()
                )
            ));
//            ->add('created_at', 'datetime')
//            ->add('updated_at', 'datetime')
              if (!$options['isNew']) {
                  $builder->add('infos', new ProductInfoType());
              }
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->entity_class,
            'isNew' => true
        ));
    }

    public function getName()
    {
        return 'product_type';
    }
}

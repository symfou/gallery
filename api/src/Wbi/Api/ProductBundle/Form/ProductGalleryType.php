<?php

namespace Wbi\Api\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductGalleryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(

            ))
            ->add('type')
            ->add('extention')
            ->add('url', 'file', array(
                'constraints' => array(
                    new NotBlank(),
                    new File(array(
                        'maxSize' => '5M',
                        'mimeTypes' => array('image/png', 'image/jpeg', 'image/jpg'),
//                        'maxSizeMessage' => ''
                    ))
                )
            ))
            ->add('thumbnail_url')
            ->add('folder')
//            ->add('product')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Wbi\Api\ProductBundle\Entity\ProductGallery'
        ));
    }

    public function getName()
    {
        return 'product_gallery_type';
    }
}

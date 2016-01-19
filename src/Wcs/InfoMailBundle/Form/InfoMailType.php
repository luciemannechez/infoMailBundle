<?php

namespace Wcs\InfoMailBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfoMailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * documents represents the virtual field in the entity but it's the name of the document which is flush in the databases in $documentsNames
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('uploadedFiles', FileType::class, array(
                'required' => false,
                'multiple' => true,
                'data_class' => null,)
            )
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Wcs\InfoMailBundle\Entity\InfoMail'
        ));
    }
}

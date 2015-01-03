<?php

namespace Dml\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('alt', 'text', array(
                'label' => 'Alt : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control')
                ))
            ->add('file', 'file', array(
                'label' => 'Fichier : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dml\BlogBundle\Entity\Image'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dml_blogbundle_imagetype';
    }
}

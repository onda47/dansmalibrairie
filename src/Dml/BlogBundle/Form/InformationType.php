<?php

namespace Dml\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InformationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('messageBouton', 'text', array(
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control')
            ))
            ->add('titre', 'text', array(
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control')
            ))
            ->add('information', 'textarea', array(
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control', 'rows' => '15')
            ))
            ->add('enPopup', null, array(
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
            ->add('afficher', null, array(
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control'),
                'required' => false
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dml\BlogBundle\Entity\Information'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dml_blogbundle_information';
    }
}

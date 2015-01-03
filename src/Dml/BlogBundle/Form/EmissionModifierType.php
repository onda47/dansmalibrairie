<?php

namespace Dml\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Dml\BlogBundle\Form\FichierSonType;

class EmissionModifierType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', 'text', array(
                'label' => 'Titre : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control', 'placeholder' => 'Les nouveautés jeunesse')
                )
            )
            ->add('participant', 'text', array(
                'label' => 'Participants : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control', 'placeholder' => 'Violène et Grégory')
                )
            )
            ->add('sujet', 'text', array(
                'label' => 'Sujet : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control', 'placeholder' => 'Les nouveautés de juillet en BD.')
                )
            )
            ->add('dateEmission', 'datetime', array(
                'label' => "Date de l'émission: ",
                'label_attr' => array('class' => 'col-md-2 control-label')
                )
            )
            ->add('description', 'textarea', array(
                'label' => 'Description : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control', 'rows' => '15', 'placeholder' => 'Nous vous présentons les dernières nouveautés jeunesse du mois d\'août.')
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
            'data_class' => 'Dml\BlogBundle\Entity\Emission'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dml_blogbundle_emission';
    }
}

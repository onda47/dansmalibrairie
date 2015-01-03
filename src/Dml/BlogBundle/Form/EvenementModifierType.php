<?php

namespace Dml\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Dml\BlogBundle\Form\ImageType;

class EvenementModifierType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', 'text', array(
                'label' => 'Nom : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control', 'placeholder' => 'Salon du livre à Moulinsart')
                )
            )
            ->add('dateDebut', 'datetime', array(
                'label' => 'Date de début : ',
                'label_attr' => array('class' => 'col-md-2 control-label')
                )
            )
            ->add('dateFin', 'datetime', array(
                'label' => 'Date de fin : ',
                'label_attr' => array('class' => 'col-md-2 control-label')
                )
            )
            ->add('description', 'textarea', array(
                'label' => 'Description : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control', 'rows' => '15', 'placeholder' => 'Profiter du salon pour rendre visite au capitaine haddock !')
                )
            );
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dml\BlogBundle\Entity\Evenement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dml_blogbundle_evenement';
    }
}

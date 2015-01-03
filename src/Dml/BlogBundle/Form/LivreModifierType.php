<?php

namespace Dml\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use \Dml\BlogBundle\Form\ImageType;

class LivreModifierType extends AbstractType
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
                'attr' => array('class' => 'form-control', 'placeholder' => 'Harry Potter')
                )
            )
            ->add('auteurLivre', 'text', array(
                'label' => 'Auteur du livre : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control', 'placeholder' => 'J.K. Rowling')
                )
            )
            ->add('edition', 'text', array(
                'label' => 'Edition : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control', 'placeholder' => 'Gallimard')
                )
            )
            ->add('datePublication', 'date', array(
                'label' => 'Date de publication : ',
                'label_attr' => array('class' => 'col-md-2 control-label')
                )
            )
            ->add('description', 'textarea', array(
                'label' => 'Critique : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control', 'rows' => '15', 'placeholder' => 'Sans commentaire: sa renommé n\'est plus à faire !')
                )
            );
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dml\BlogBundle\Entity\Livre'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dml_blogbundle_livre';
    }
}

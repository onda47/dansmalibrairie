<?php

namespace Dml\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', 'text', array(
                'label' => 'Prénom : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control', 'placeholder' => 'Gaston'),
                ))
            ->add('nom', 'text', array(
                'label' => 'Nom : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control', 'placeholder' => 'Lagaffe'),
                ))
            ->add('courriel', 'text', array(
                'label' => 'Courriel : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control', 'placeholder' => 'gaston-lagaffe@journal-spirou.fr')
                ))
            ->add('sujet', 'text', array(
                'label' => 'Sujet : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control', 'placeholder' => 'Contrat pour M. De Mesmaeker')
                ))
            ->add('contenu', 'textarea', array(
                'label' => 'Contenu : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control', 'placeholder' => 'Spirou ! Ma mouette a manger le contrat !', 'rows' => '13')
                ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dml\BlogBundle\Entity\Mail'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dml_blogbundle_mailtype';
    }
}

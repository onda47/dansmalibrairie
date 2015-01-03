<?php

namespace Dml\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Dml\BlogBundle\Form\ImageType;

class ProduitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prix', 'money', array(
                'currency' => false,
                'label' => 'Prix : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control')
                ))
            ->add('messageFlash', 'textarea', array(
                'label' => 'Message flash : ',
                'required' => false,
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control', 'rows' => '10')
                ))
            ->add('statut', 'choice', array(
                'choices' => array('Disponible' => 'Disponible', 'Indisponible' => 'Indisponible', 'En précommande' => 'En précommande'),
                'label' => 'Statut : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control', 'rows' => '10')
                ))
            ->add('sousCategorieProduit', 'entity', array(
                'class' =>'DmlBlogBundle:SousCategorieProduit',
                'property' => 'nom',
                'empty_value' => false,
                'required' => true,
                'label' => 'Sous catégorie de produit : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control')
                ))
            ->add('image', new ImageType());
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dml\BlogBundle\Entity\Produit'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dml_blogbundle_produittype';
    }
}

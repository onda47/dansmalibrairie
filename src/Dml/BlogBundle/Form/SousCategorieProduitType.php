<?php

namespace Dml\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SousCategorieProduitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text', array(
                'label' => 'Nom de la sous catégorie : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control')))
            ->add('categorieProduit', 'entity', array(
                'class' =>'DmlBlogBundle:CategorieProduit',
                'property' => 'nom',
                'empty_value' => false,
                'required' => true,
                'label' => 'Catégorie : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control')
                ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dml\BlogBundle\Entity\SousCategorieProduit'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dml_blogbundle_souscategorieproduittype';
    }
}

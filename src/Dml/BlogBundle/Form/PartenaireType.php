<?php

namespace Dml\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PartenaireType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lien', 'text', array(
                'label' => 'Lien : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control')
                ))
            ->add('lienAfficher', 'text', array(
                'label' => 'Nom du partenaire : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control')
                ))
            ->add('categoriePartenaire', 'entity', array(
                'class' =>'DmlBlogBundle:CategoriePartenaire',
                'property' => 'nom',
                'empty_value' => false,
                'required' => true,
                'label' => 'Catégorie de partenaire : ',
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
            'data_class' => 'Dml\BlogBundle\Entity\Partenaire'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dml_blogbundle_partenairetype';
    }
}

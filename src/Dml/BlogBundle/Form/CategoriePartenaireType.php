<?php

namespace Dml\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoriePartenaireType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text', array(
                'label' => 'Nom : ',
                'label_attr' => array('class' => 'col-md-1 control-label'),
                'attr' => array(
                    'class' => 'col-md-1 form-control',
                    'placeholder' => 'Ex : Nos salons'
                    ),
                )
            )
            ->add('priorite', 'integer', array(
                'label' => 'Priorité : ',
                'label_attr' => array('class' => 'col-md-1 control-label'),
                'attr' => array(
                    'class' => 'col-md-1 form-control',
                    'placeholder' => 'Ex : 1'
                    ),
                )
            );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dml\BlogBundle\Entity\CategoriePartenaire'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dml_blogbundle_categoriepartenairetype';
    }
}

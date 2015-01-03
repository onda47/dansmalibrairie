<?php

namespace Dml\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsletterType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datePublication', 'date', array(
                'label' => 'Date de publication : ',
                'label_attr' => array('class' => 'col-md-2 control-label')
                )
            )
            ->add('codeHtml', 'textarea', array(
                'label' => 'Code HTML : ',
                'label_attr' => array('class' => 'col-md-2 control-label'),
                'attr' => array('class' => 'form-control', 'rows' => '15')
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
            'data_class' => 'Dml\BlogBundle\Entity\Newsletter'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dml_blogbundle_newsletter';
    }
}

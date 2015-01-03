<?php

namespace Dml\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GallerieType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateAjout', 'date', array(
                'label' => "Date d'ajout : ",
                'label_attr' => array('class' => 'col-md-2 control-label')
                )
            )
            ->add('image', new ImageType())
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dml\BlogBundle\Entity\Gallerie'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dml_blogbundle_gallerie';
    }
}

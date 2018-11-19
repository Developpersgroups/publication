<?php

namespace FLSHR\gestionPublicationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FLSHR\gestionPublicationBundle\Form\UtilisateurType;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reduction' , 'choice' , array('label' => 'Réduction',
                'choices'=> array('25'      =>'25%',
                                  '50'      =>'50%',
                                  '80'      =>'80%',
                                  '100'     =>'don'),
                    'empty_value' => 'Choisissez une réduction',
                    'empty_data' => null , 
                ))
            ->add('uti' , new UtilisateurType() , array('label' => 'Client'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FLSHR\gestionPublicationBundle\Entity\Commande'
        ));
    }

    public function getName()
    {
        return 'flshr_gestionpublicationbundle_commandetype';
    }
}

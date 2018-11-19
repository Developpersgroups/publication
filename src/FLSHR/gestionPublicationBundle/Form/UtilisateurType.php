<?php

namespace FLSHR\gestionPublicationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeutilisateur' , 'choice' , array('label' => 'Type de client' , 
                'choices'=> array('Professeur interne'   =>'Professeur interne',
                                  'Etudiant interne'     =>'Etudiant interne',
                                  'Professeur externe'   =>'Professeur externe',
                                  'Etudiant externe'     =>'Etudiant externe',
                                  'Etablissement'        =>'Etablissement'),
                    'empty_value' => 'Choisissez un type de client',
                    'empty_data' => null , 
                ))
                
            ->add('email' , 'email' , array('label' => 'E-mail'))
            ->add('cin' ,'text' , array('label' => 'C.I.N' , 'required'=>false ))
            ->add('cne' ,'text' , array('label' => 'C.N.E' , 'required'=>false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FLSHR\gestionPublicationBundle\Entity\Utilisateur'
        ));
    }

    public function getName()
    {
        return 'flshr_gestionpublicationbundle_utilisateurtype';
    }
}

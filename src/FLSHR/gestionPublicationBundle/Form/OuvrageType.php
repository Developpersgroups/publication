<?php

namespace FLSHR\gestionPublicationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OuvrageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre' , 'text' , array('label' => 'Titre' ))
            ->add('auteur' , 'text' , array('label' => 'Auteur'))
            ->add('editeur' ,'text' , array('label' => 'Editeur' , 'read_only'=>true))
            ->add('serie' ,'text' , array('label' => 'série' , 'required'=> false))
            ->add('impression' , 'text' , array('label' => 'Impression' , 'required'=>false))
            ->add('depotLegal' , 'text' , array('label' => 'Depot légal' , 'required'=> false ))
            ->add('isbn' , 'text' , array('label' => 'ISBN',"required"=> false))
            ->add('issn' , 'text' , array('label' => 'ISSN' , "required"=> false))
            ->add('edition' , 'text' , array('label' => 'Edition' , "required"=> false))
            ->add('prix' , 'integer' , array('label' => 'Prix' , "required"=> true))
            ->add('qutestocke' , 'integer' , array('label' => 'Quantité stockée' , "required"=> true))
            ->add('file' , 'file' , array('label' => 'Photo' ,"required"=> false))
            ->add('descrption' , 'textarea' , array('label' => 'Discription' , "required"=> false))
            ->add('dateentree' ,'date' , array('label' => 'Date d\'entrée' , "required"=> false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FLSHR\gestionPublicationBundle\Entity\Ouvrage'
        ));
    }

    public function getName()
    {
        return 'flshr_gestionpublicationbundle_ouvragetype';
    }
}

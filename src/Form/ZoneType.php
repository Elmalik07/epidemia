<?php

namespace App\Form;

use App\Entity\Pays;
use App\Entity\Zone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ZoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array('required'=>true, 'label'=>'Nom_Zone', 'attr'=>array('class'=>'form-group form-control')))
            ->add('pays', EntityType::class, array('class'=>Pays::class, 'label'=>'Pays', 'attr'=>array('class'=>'form-group form-control')))
            ->add('Envoyer', SubmitType::class, array('attr'=>array('class'=>'btn btn-success')))
            ->add('Annuler', ResetType::class, array('attr'=>array('class'=>'btn btn-danger')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Zone::class,
        ]);
    }
}

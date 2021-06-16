<?php

namespace App\Form;

use App\Entity\Constat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConstatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateAccident', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false 
                ])
            ->add('lieu', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false 
                ])
            ->add('Choc', FileType::class,[
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])
        ->add('nomConducteur', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
                ])

            ->add('prenomConducteur', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
                ])
            ->add('nombreVehicule', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Constat::class,
        ]);
    }
}

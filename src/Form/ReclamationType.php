<?php

namespace App\Form;

use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, [
                'attr' => ['class' => 'form-control'],
                ])
            ->add('prenom', null, [
                'attr' => ['class' => 'form-control'],
                ])
            ->add('email', null, [
                'attr' => ['class' => 'form-control'],
                ])
            ->add('Immatriculation', null, [
                'attr' => ['class' => 'form-control'],
                ])
            ->add('tel', null, [
                'attr' => ['class' => 'form-control'],
                ])

            ->add('Desciption', TextareaType::class, [
                'attr' => ['class' => 'tinymce'],
            ])

            ->add('Responsable',ChoiceType::class, [
                'choices'  => [
                    'Expert en sinistre' => 'Expert en sinistre',
                    'conseiller' => 'conseiller',
                ], 'attr' => ['class' => 'form-control'],
                'required' => true,
                'label' => false ,
           
                ]);
            
      
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}

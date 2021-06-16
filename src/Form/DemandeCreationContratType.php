<?php

namespace App\Form;
use App\Entity\DemandeCreationContrat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class DemandeCreationContratType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false 
                ])
            ->add('prenom', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false 
                ])
            ->add('cin', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false 
                ])
            ->add('email', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false ,
                'invalid_message' => 'The email is not a valid email. '
                ])


            ->add('age', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
            ])

            ->add('nomVoiture',ChoiceType::class, [
                'choices'  => [
                    'Polo' => 'Polo',
                    'Golf' => 'Golf',
                    'C3' => 'C3',
                    'C4' => 'C4',
                    'C1' => 'C1',
                    'Fiat' => 'Fiat',
                    'Corolla' => 'Corolla',
                    'Aygo' => 'Aygo',
                    'Passat' => 'Passat',
                    ' Fiat 500 X' => ' Fiat 500 X',
                    ' Fiat Panda' => ' Fiat Panda',
                    '  Mercedes Classe A' => '  Mercedes Classe A',
                    'MERCEDES CLASSE C' => ' MERCEDES CLASSE C',
                    ' Mercedes Classe B' => ' Mercedes Classe B',



                ], 'attr' => ['class' => 'form-control'],
                'required' => true,
                'label' => false ,

            ])
            ->add('typeVoiture',ChoiceType::class, [
                'choices'  => [
                    'Peugeot' => 'Peugeot',
                    'Renault' => 'Renault',
                    'Citroën' => 'Citroën',
                    'Fiat' => 'Fiat',
                    'Mercedes' => 'Mercedes',
                    'Toyota' => 'Toyota',

                ], 'attr' => ['class' => 'form-control'],
                'required' => true,
                'label' => false ,

            ])

        ->add('kilometre', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
            ])
            ->add('FrequencePeriodicite', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
            ])
            ->add('modePaiement', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
            ])
            ->add('companie', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
            ])

          ->add('grantie', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
            ])
        ->add('immatriculation', null, [
            'attr' => ['class' => 'form-control'],
            'label' => false
        ])
        ->add('clause', null, [
            'attr' => ['class' => 'form-control'],
            'label' => false
        ])
        ->add('typeContrat', null, [
            'attr' => ['class' => 'form-control'],
            'label' => false
        ])


        ->add('Uploadcin', FileType::class,[
            'label' => false,
            'multiple' => true,
            'mapped' => false,
            'required' => false
        ])
        ->add('Uploadpermis', FileType::class,[
            'label' => false,
            'multiple' => true,
            'mapped' => false,
            'required' => false
        ])
        ->add('UploadCartegrise', FileType::class,[
            'label' => false,
            'multiple' => true,
            'mapped' => false,
            'required' => false
        ])
        ->add('UploadProfil', FileType::class,[
        'label' => false,
        'multiple' => true,
        'mapped' => false,
        'required' => false
    ])
    ->add('UploadVignette', FileType::class,[
        'label' => false,
        'multiple' => true,
        'mapped' => false,
        'required' => false
    ])

    ->add('UploadVisitetechnique', FileType::class,[
        'label' => false,
        'multiple' => true,
        'mapped' => false,
        'required' => false
    ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DemandeCreationContrat::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('nom', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false 
                ])
            ->add('prenom', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false 
                ])
                ->add('mobile', null, [
                    'attr' => ['class' => 'form-control'],
                    'label' => false 
                    ])
                ->add('statut', ChoiceType::class, [
                        'choices'  => [
                            'Manager' =>'Manager',
                            'Admin' => 'Admin',
                            'Souscripteur' =>'Souscripteur',
                            'Agent' => 'Agent',
      
                        ],
                        'attr' => ['class' => 'form-control'],
                        'required' => true,
                        'label' => false ,
                    ])
                ->add('adresse', null, [
                    'attr' => ['class' => 'form-control'],
                    'label' => false 
                    ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}

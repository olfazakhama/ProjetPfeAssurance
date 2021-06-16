<?php

namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', null, [
                'attr' => ['class' => 'form-control'],
                ])
            ->add('nom', null, [
                'attr' => ['class' => 'form-control'],
                ])
            ->add('prenom', null, [
                'attr' => ['class' => 'form-control'],
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
            ->add('mobile', null, [
                'attr' => ['class' => 'form-control'],
                ])
            ->add('adresse', null, [
                'attr' => ['class' => 'form-control'],
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

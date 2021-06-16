<?php

namespace App\Form;

use App\Entity\Assure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AssureType extends AbstractType
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
            ->add('adresse', null, [
                'attr' => ['class' => 'form-control'],
                ])
            ->add('cin', null, [
                'attr' => ['class' => 'form-control'],
                ])
            ->add('tel', null, [
                'attr' => ['class' => 'form-control'],
                ])
            ->add('civilite',ChoiceType::class, [
                'choices'  => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                ], 'attr' => ['class' => 'form-control'],
                'required' => true,
                'label' => false ,
           
                ]);
            
      
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Assure::class,
        ]);
    }
}

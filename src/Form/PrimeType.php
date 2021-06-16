<?php

namespace App\Form;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use App\Entity\Prime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class PrimeType extends AbstractType
{

  
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('annee', null, [
            'attr' => ['class' => 'form-control'],
            'label' => false 
            ])
    
            ->add('montantInitiale', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false 
                ])
            ->add('montantFrequence', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false 
                ])
            
           
        
        ;

    }
  
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prime::class,
        ]);
    }
}

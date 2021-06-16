<?php

namespace App\Form;

use App\Entity\Encaissement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EncaissementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('montant', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false 
                ])
            ->add('date')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Encaissement::class,
        ]);
    }
}

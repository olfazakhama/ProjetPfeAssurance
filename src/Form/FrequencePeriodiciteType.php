<?php

namespace App\Form;

use App\Entity\FrequencePeriodicite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FrequencePeriodiciteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false 
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FrequencePeriodicite::class,
        ]);
    }
}

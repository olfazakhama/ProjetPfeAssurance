<?php

namespace App\Form;

use App\Entity\Bonus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BonusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('annee', null, [
                'attr' => ['class' => 'form-control'],
                ])
            ->add('coefficient', null, [
                'attr' => ['class' => 'form-control'],
                ])
            ->add('bonus', null, [
                'attr' => ['class' => 'form-control'],
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bonus::class,
        ]);
    }
}

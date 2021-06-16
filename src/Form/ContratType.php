<?php

namespace App\Form;

use App\Entity\Contrat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ContratType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('dateValidite', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ])
            ->add('kilometre', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
            ])
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
                'label' => false
            ])

            ->add('age', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
            ])

            ->add('immatriculation', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
            ])
            ->add('nomVoiture', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
            ])
            ->add('typeVoiture', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
            ])
            ->add('typeContrat', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
            ])
            ->add('clause', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
            ])

            ->add('grantie', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
            ])
            ->add('companie', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
            ])
            ->add('modePaiement', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
            ])
            ->add('FrequencePeriodicite', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false
            ])




        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contrat::class,
        ]);
    }
}

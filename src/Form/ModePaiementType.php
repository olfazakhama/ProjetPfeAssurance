<?php

namespace App\Form;

use App\Entity\ModePaiement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
 
class ModePaiementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, [
                'attr' => ['class' => 'form-control'],
                'label' => false 
                ])
            ->add('frequence',ChoiceType::class, [
                'choices'  => [
                    'Semestrielle' => 'Semestrielle',
                    'Annuelle' => 'Annuelle',
                ],
                'attr' => ['class' => 'form-control'],
                'required' => true,
                'label' => false ,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ModePaiement::class,
        ]);
    }
}

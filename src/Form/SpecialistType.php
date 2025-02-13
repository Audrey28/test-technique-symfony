<?php

namespace App\Form;

use App\Entity\Specialist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecialistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstName', null, [
            'label' => 'Prénom'
        ])
        ->add('lastName', null, [
            'label' => 'Nom'
        ])
        ->add('online', null, [
            'label' => 'En ligne'
        ])
        ->add('active', null, [
            'label' => 'Actif'
        ])
        ->add('description', null, [
            'label' => 'Description'
        ])
        ->add('mobile', null, [
            'label' => 'Numéro de téléphone mobile'
        ])
        ->add('email', null, [
            'label' => 'Email'
        ])
        ->add('city', null, [
            'label' => 'Ville'
        ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Specialist::class,
        ]);
    }
}

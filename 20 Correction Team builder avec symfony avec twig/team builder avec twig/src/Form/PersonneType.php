<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\Personne;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', null, [
                'label' => '',
                'attr' => [
                    'placeholder' => 'Prénom',
                    'class' => 'my-2'
                ]
            ])
            ->add('nom', null, [
                'label' => '',
                'attr' => [
                    'placeholder' => 'Nom',
                    'class' => 'my-2'
                ]
            ])
            ->add('equipes', EntityType::class, [
                'class' => Equipe::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'mapped' => false,
               
                'label' => 'Equipes :',
                'attr' => [
                    'placeholder' => 'Prénom',
                    'class' => 'my-2'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personne::class,
        ]);
    }
}

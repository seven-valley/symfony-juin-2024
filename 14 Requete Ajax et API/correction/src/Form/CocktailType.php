<?php

namespace App\Form;

use App\Entity\Cocktail;
use App\Entity\Couleur;
use App\Entity\Fruit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CocktailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('couleur', EntityType::class, [
                'class' => Couleur::class,
                'choice_label' => 'nom',
                'mapped' => false,
            ])
            ->add('fruit', EntityType::class, [
                'class' => Fruit::class,
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cocktail::class,
        ]);
    }
}

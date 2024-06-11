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
            ->add('prenom',null,[ 'attr'=> ['placeholder'=>'Prénom']])
            ->add('nom',null,[ 'attr'=> ['placeholder'=>'Nom','class'=>'mt-2']])
            ->add('equipe', EntityType::class, [
                'class' => Equipe::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'mapped'=> false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personne::class,
        ]);
    }
}

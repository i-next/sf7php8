<?php

namespace App\Form;

use App\Entity\EnumStates;
use App\Entity\Plant;
use App\Entity\Seed;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('state', EnumType::class, [
                'class' => EnumStates::class,
                'choice_label' => 'value'
            ])

            ->add('date_flo', HiddenType::class)
            ->add('seedid', EntityType::class, [
                'class' => Seed::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plant::class,
        ]);
    }
}

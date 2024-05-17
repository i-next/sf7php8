<?php

namespace App\Form;

use App\Entity\MySeeds;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddMySeedsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantity', IntegerType::class, [
                'required' => true,
                'data' => 1
            ])
            ->add(
                'strainId',
                HiddenType::class,
                [
                'mapped' => false,
                'data' => $options['require_strain_id']
                ]
            )
            ->add('comment')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MySeeds::class,
            'require_strain_id' => null,
        ]);
    }
}

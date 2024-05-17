<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeletePlantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('state',HiddenType::class,[
                'data' => $options['data']['state']
            ])
            ->add('idmyplants',HiddenType::class,[
                'data' => $options['data']['idmyplant']
            ])
            ->add('validate',HiddenType::class,[
                'data' => "1"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
            'data' => null,
        ]);
    }
}

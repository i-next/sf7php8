<?php

namespace App\Form;

use App\Entity\EnumStates;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class ChangeStateMyPlantsType extends AbstractType
{
    public function __construct(private readonly TranslatorInterface $translator)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_active',DateType::class,[
                'input'  => 'datetime_immutable',
                'data' => new \DateTimeImmutable()
            ])
            ->add('newstate',HiddenType::class,[
                'data' => $options['data']['newstate']
            ])
            ->add('state',HiddenType::class,[
                'data' => $options['data']['state']
            ])
            ->add('idmyplants',HiddenType::class,[
                'data' => $options['data']['idmyplant']
            ]);
        if($options['data']['newstate'] === EnumStates::REC->value){
            $builder->add('weight',IntegerType::class,[
                'label' => $this->translator->trans('form.label.changestate.weight')
            ])
                ->add('notes',TextareaType::class,[
                    'required' => false,
                ]);
        }

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
            'data' => null,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\MySeeds;
use App\Repository\StrainRepository;
use App\Repository\BreederRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class MySeedsType extends AbstractType
{
    public function __construct(private readonly StrainRepository $strainRepository, private readonly BreederRepository $breederRepository, private readonly TranslatorInterface $translator)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('strain', StrainAutocompleteField::class, [
                'label_attr' => [
                    'class' => 'required textform',
                ]
            ])
            ->add('newstrain', StrainType::class, [
                'mapped' => false,
                'label' => false,
            ])
            ->add('quantity', IntegerType::class, [
                'attr' => [
                    'required' => true,
                    'class' => 'smallnumber',
                ],
                'data' => 1
            ])
            ->add('comment',TextType::class,[
                'attr' => ['class' => 'textform']
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success'],
                'label' => 'submit'
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MySeeds::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Strain;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StrainType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $ckEditorOptions = ['config' => ['toolbar' => 'basic', 'uiColor' => '#73b64f'], 'required' => false];
        $builder
            ->add('breeder', BreederAutocompleteField::class, [
                'required' => false,
            ])
            ->add('newbreeder', BreederType::class, [
                'required' => false,
                'mapped' => false,
                'label' => false,
            ])
            ->add('auto')
            ->add('duration', IntegerType::class, [
                'required' => false,
            ])
            ->add('type')
            ->add('url_photo');
        if(\Locale::getDefault() === 'fr') {
            $builder->add('description', CKEditorType::class, $ckEditorOptions);
        } else {
            $builder->add('descriptionen', CKEditorType::class, $ckEditorOptions);
        };

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Strain::class,
        ]);
    }
}

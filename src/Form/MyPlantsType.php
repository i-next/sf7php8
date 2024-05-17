<?php

namespace App\Form;

use App\Entity\MyPlants;
use App\Entity\MySeeds;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
//use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MyPlantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'data' => $options['data']->getMySeeds()->getStrain()->getName(),
            ])
            ->add('duration',NumberType::class,[
                'data' => $options['data']->getMySeeds()->getStrain()->getDuration(),
            ])
            /*->add('date_created', null, [
                'widget' => 'single_text',
            ])
            ->add('date_updated', null, [
                'widget' => 'single_text',
            ])*/
            ->add('my_seeds', EntityType::class, [
                'class' => MySeeds::class,
                'choice_label' => 'id',
                'attr' => ['style' =>'display:none;'],
                'label_attr' => ['style' =>'display:none;']
            ])
            ->add('date_germination',DateType::class,[
                'mapped' => false,
                'data'  => new \DateTimeImmutable(),
            ])
            ->add('seedid',HiddenType::class,[
                'mapped' => false,
                'data' => $options['require_seed_id']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MyPlants::class,
            'data' => 'data',
            'require_seed_id' => null
        ]);
    }
}

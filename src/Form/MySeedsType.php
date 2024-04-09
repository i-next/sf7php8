<?php

namespace App\Form;

use App\Entity\Breeder;
use App\Entity\MySeeds;
use App\Entity\Strain;
use App\Repository\StrainRepository;
use App\Repository\BreederRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MySeedsType extends AbstractType
{

    public function __construct(private readonly StrainRepository $strainRepository, private readonly BreederRepository $breederRepository)
    {
    }



    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('seeder')
            ->add('quantity')
            ->add('duration')
            ->add('description');

        $builder->addEventListener(FormEvents::PRE_SET_DATA,function(FormEvent $event): void{
            $data = $event->getData();
            $form = $event->getForm();

            $breeder = $data?->getBreeder();

            $this->addElements($form,$breeder);

        });
        $builder->addEventListener(FormEvents::POST_SET_DATA,function(FormEvent $event): void{
            $data = $event->getData();
            $form = $event->getForm();

            $breeder = $data?->getBreeder();

            $this->addElements($form,$breeder);

        });
        $builder->addEventListener(FormEvents::PRE_SUBMIT, function(FormEvent $event): void{
            $data = $event->getData();
            $form = $event->getForm();
            $breeder = $this->breederRepository->find($data['breeder']);

            $this->addElements($form,$breeder);
        });
    }

    protected function addElements(Form $form, ?Breeder $breeder = null): void
    {
        $form->add('breeder', EntityType::class, [
            'mapped'        => false,
            'class'         => breeder::class,
            'data'          => $breeder,
            'choice_label'  => 'name',
            'placeholder'    => 'Select your breeder...'
         ]);
        $strains = null;

        $strains = $breeder?->getStrains();

        if($strains){
            $form->add('strain',EntityType::class,[
                'class'          => Strain::class,
                'placeholder'    => 'Select your strain ...',
                'data'         => $strains,
                'required'       => true,
                'choice_label'   => 'name'
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MySeeds::class,
        ]);
    }
}

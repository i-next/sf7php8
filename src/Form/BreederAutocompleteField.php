<?php

namespace App\Form;

use App\Entity\Breeder;
use App\Repository\BreederRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;
use Symfony\Contracts\Translation\TranslatorInterface;

#[AsEntityAutocompleteField]
class BreederAutocompleteField extends AbstractType
{

    public function __construct(private readonly TranslatorInterface $translator, private readonly Security $security)
    {
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Breeder::class,
            'required' => false,
            'placeholder' => $this->translator->trans('form.placeholder.breeder.breeder'),
            'choice_label' => 'name',
            'tom_select_options' => [
                'create' => true,
            ],
            'query_builder' => function (BreederRepository $breederRepository) {
                return $breederRepository->createQueryBuilder('breeder');
            },
            'preload' => true,
            'maxOptions' => null,
            /*'attr' => [
                'data-controller' => 'hello',
                ],*/
            // 'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return BaseEntityAutocompleteType::class;
    }

    private function test(): void
    {
        dd('test');
    }
}

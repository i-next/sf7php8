<?php

namespace App\Form;

use App\Entity\Strain;
use App\Repository\StrainRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\SecurityBundle\Security;

#[AsEntityAutocompleteField(route: 'app_strain_autocomplestrain')]
class StrainAutocompleteField extends AbstractType
{

    public function __construct(private readonly TranslatorInterface $translator, private readonly Security $security)
    {
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'required' => false,
            'class' => Strain::class,
            'placeholder' => $this->translator->trans('form.placeholder.strain.strain'),
            'label' => $this->translator->trans('form.label.strain.strain'),
            'choice_label' => function($obj){
            return $obj->getName().' ('.$obj->getBreeder()->getName().')';
            },
            'searchable_fields' => ['name'],
            'query_builder' => function (StrainRepository $strainRepository) {
                return $strainRepository->createQueryBuilder('strain')
                    ->leftJoin('strain.breeder','b')->where('b = strain.breeder')->andWhere('strain.user_id = '.$this->security->getUser()->getId().' OR strain.user_id IS NULL')->orderby('b.name','ASC')->addOrderBy('strain.name','ASC');
            },
            'attr' => [
                'class' => 'selstrain shortfield form-control',
                'data-controller' => 'autocomplete_strain',
                ],
            /*'tom_select_options' => [
                'create' => true,
                'render' => [
                    'option_create' => function( $data, $escape ){
                        return 'toto';
                        //return '<div class="create">Ajouter <strong>' + escape($data['input']) + '</strong>&hellip;</div>';
                    }
                ],
                'openOnFocus' => false,
                'maxOptions' => null,
                'sortField' => ['field' => '$score', 'field' => '$order']
            ],*/
/*            'min_characters' => 5,
            'preload' => true,
            'maxOptions' => null,
            'max_results' => 5000,*/
            //'sort' => ['name' => 'asc'],
            //'sortField' => ['field'=>'text','field'=> '$score'],
            // 'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return BaseEntityAutocompleteType::class;
    }
}

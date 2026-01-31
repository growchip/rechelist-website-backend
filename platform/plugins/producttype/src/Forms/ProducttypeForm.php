<?php

namespace Botble\ProductType\Forms;

use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\ProductType\Http\Requests\ProducttypeRequest;
use Botble\ProductType\Models\Producttype;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;


class ProducttypeForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->model(Producttype::class)
            ->setValidatorClass(ProducttypeRequest::class)
            ->add('title', TextField::class, NameFieldOption::make()->required())
            ->add('slug', TextField::class, NameFieldOption::make()->required()->placeholder('Slug')->label('Slug')
            ->label('Slug')
            ->placeholder('slug')
            ->required()
        )
            ->add('desc', TextareaField::class, DescriptionFieldOption::make()->label('Description')->placeholder('Description')->maxLength(10000))
            ->add('short_desc', TextareaField::class, DescriptionFieldOption::make()->label('Short Description')->maxLength(1000))
              ->add(
                'image', 
                MediaImageField::class, 
                MediaImageFieldOption::make()
                    ->label(__('Image'))
            ) ->add('seo_title', 'text', [
            'label' => 'SEO Title',
            'label_attr' => ['class' => 'control-label'],
            'attr' => ['placeholder' => 'SEO Title'],
        ])
        ->add('seo_description', 'textarea', [
            'label' => 'SEO Description',
            'label_attr' => ['class' => 'control-label'],
            'attr' => ['placeholder' => 'SEO Description'],
        ])
        ->add('seo_image', 'mediaImage', [
            'label' => 'SEO Image',
        ])
            ->add('status', SelectField::class, StatusFieldOption::make())
            ->setBreakFieldPoint('status') 
            ->add('banner_image', 'mediaImage', [
            'label' => 'Banner Image',
        ]);
    }
}

<?php

namespace Botble\Category\Forms;

use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\FormAbstract;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;
use Botble\Category\Http\Requests\CategoryRequest;
use Botble\Category\Models\Category;

class CategoryForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->model(Category::class)
            ->setValidatorClass(CategoryRequest::class)
            // ->add('name', TextField::class, NameFieldOption::make()->required())
            ->add('title', TextField::class, NameFieldOption::make()->required()->placeholder('Title')->label('Title'))
            ->add('slug', TextField::class, NameFieldOption::make()->required()->placeholder('Slug')->label('Slug')
    ->label('Slug')
    ->placeholder('slug')
    ->required()
)

              ->add(
                'image', 
                MediaImageField::class, 
                MediaImageFieldOption::make()
                    ->label(__('Image'))
            )
               ->add('short_desc', TextareaField::class, DescriptionFieldOption::make()->label('Short Description')->maxLength(1000))
            ->add('description', TextareaField::class, DescriptionFieldOption::make()->label('Description')->placeholder('Description')->maxLength(10000))->add('seo_title', 'text', [
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
            ->setBreakFieldPoint('status') ->add('banner_image', 'mediaImage', [
            'label' => 'Banner Image',
        ]);
    }
}

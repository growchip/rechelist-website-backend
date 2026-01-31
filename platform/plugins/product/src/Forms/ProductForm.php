<?php

namespace Botble\Product\Forms;

use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FormAbstract;
use Botble\Product\Http\Requests\ProductRequest;
use Botble\Product\Models\Product;
use Botble\Product\Models\ProductCategory;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Category\Models\Category;

use Botble\ProductType\Models\ProductType;

class ProductForm extends FormAbstract
{
    public function setup(): void
    {
        $this->setupModel(new Product());

        $model = $this->getModel();

       
        if ($model instanceof Product && $model->exists) {
            $typeList = ProductType::pluck('title', 'id')->toArray();
        } else {
            $typeList = ProductType::pluck('title', 'id')->toArray();
        }
        $selectedType = $model instanceof Product && $model->exists ? $model->type_id : null;

        $categories = Category::pluck('title', 'id')->toArray();
        $selectedCategories = [];
        if ($model instanceof Product && $model->exists) {
            $selectedCategories = $model->categories()->pluck('product_category_id')->toArray();
            // dd($selectedCategories);
        }

        $this
            ->model(Product::class)
            ->setValidatorClass(ProductRequest::class)
            ->add(
                'categories[]',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(trans('categories'))
                    ->choices($categories)
                    ->selected($selectedCategories)
                    // ->selected(!empty($selectedCategories) ? $selectedCategories : array_keys($categories)) // Select all by default if none selected
                    ->attributes(['multiple' => true])
                    ->searchable()
                    ->toArray()
            )
            



            ->add('title', TextField::class, NameFieldOption::make()->required()->label('Title')->placeholder('Enter Name'))
             ->add('desc', TextareaField::class, DescriptionFieldOption::make()->label('Description')->  maxLength(1000))
             ->add('brand_name', TextField::class, NameFieldOption::make()->required()->label('Brand Name')->placeholder('Enter Brand Name'))
            
            ->add('combination', TextField::class, NameFieldOption::make()->required()->label('Combination')->placeholder('Enter Combination'))
                ->add(
                'image', 
                MediaImageField::class, 
                MediaImageFieldOption::make()
                    ->label(__('Image'))
            )
         
           ->add('mrp', \Botble\Base\Forms\Fields\NumberField::class, [
                'label' => 'MRP',
                'attr' => [
                    'min' => 0,
                    'step' => 1,
                    'placeholder' => 'Enter MRP',
                ],
            ])
        ->add('pack', TextField::class, NameFieldOption::make()->required()->label('Pack Name')->placeholder('Enter Pack'))
        ->add('type_id', SelectField::class, [
            'label' => __('Product Type'),
            'choices' => $typeList,
            // 'selected' => $selectedType,
            'attr' => [
                'class' => 'form-control',
            ],
            
        ])
            ->add('status', SelectField::class, StatusFieldOption::make())
            ->setBreakFieldPoint('status');
    }
}

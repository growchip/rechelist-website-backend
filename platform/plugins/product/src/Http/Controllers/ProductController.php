<?php

namespace Botble\Product\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Product\Http\Requests\ProductRequest;
use Botble\Product\Models\Product;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Product\Tables\ProductTable;
use Botble\Product\Forms\ProductForm;
use Illuminate\Support\Str;

class ProductController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans(trans('plugins/product::product.name')), route('product.index'));
    }

    public function index(ProductTable $table)
    {
        $this->pageTitle(trans('plugins/product::product.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/product::product.create'));

        return ProductForm::create()->renderForm();
    }

    public function store(ProductRequest $request)
    {
        $form = ProductForm::create()->setRequest($request);
        $product = $form->getModel();
        
        $form->save();

        $categoryIds = collect($request->input('categories'))
                ->flatten()
                ->filter() // optional: removes null/empty
                ->map(fn($id) => (int) $id) // ensure they are integers
                ->toArray();

            $product->categories()->sync($categoryIds);
           
            $baseSlug = Str::slug($request->combination);
            
            
            $slug = $baseSlug;
            $i = 1;
                
            while (
                Product::where('slug', $slug)
                    ->where('id', '!=', $product->id)
                    ->exists()
                ) {
                    $slug = $baseSlug . '-' . $i;
                    $i++;
                }

                $product->slug = $slug;

            $product->save();
        return $this
            ->httpResponse()
            ->setPreviousUrl(route('product.index'))
            ->setNextUrl(route('product.edit', $form->getModel()->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(Product $product)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $product->name]));

        return ProductForm::createFromModel($product)->renderForm();
    }

    public function update(Product $product, ProductRequest $request)
    {
        ProductForm::createFromModel($product)
            ->setRequest($request)
            ->save();

        $categoryIds = collect($request->input('categories'))
                ->flatten()
                ->filter() // optional: removes null/empty
                ->map(fn($id) => (int) $id) // ensure they are integers
                ->toArray();
          
           
            $product->categories()->sync($categoryIds);
            $product->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('product.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(Product $product)
    {
        return DeleteResourceAction::make($product);
    }
}

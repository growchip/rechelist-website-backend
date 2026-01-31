<?php

namespace Botble\ProductType\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\ProductType\Http\Requests\ProducttypeRequest;
use Botble\ProductType\Models\Producttype;
use Botble\Base\Http\Controllers\BaseController;
use Botble\ProductType\Tables\ProducttypeTable;
use Botble\ProductType\Forms\ProducttypeForm;

class ProducttypeController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans(trans('plugins/producttype::producttype.name')), route('producttype.index'));
    }

    public function index(ProducttypeTable $table)
    {
        $this->pageTitle(trans('plugins/producttype::producttype.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/producttype::producttype.create'));

        return ProducttypeForm::create()->renderForm();
    }

    public function store(ProducttypeRequest $request)
    {
        $form = ProducttypeForm::create()->setRequest($request);

        $form->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('producttype.index'))
            ->setNextUrl(route('producttype.edit', $form->getModel()->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(Producttype $producttype)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $producttype->name]));

        return ProducttypeForm::createFromModel($producttype)->renderForm();
    }

    public function update(Producttype $producttype, ProducttypeRequest $request)
    {
        ProducttypeForm::createFromModel($producttype)
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('producttype.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(Producttype $producttype)
    {
        return DeleteResourceAction::make($producttype);
    }
}

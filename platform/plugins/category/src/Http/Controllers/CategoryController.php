<?php

namespace Botble\Category\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Category\Http\Requests\CategoryRequest;
use Botble\Category\Models\Category;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Category\Tables\CategoryTable;
use Botble\Category\Forms\CategoryForm;

class CategoryController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans(trans('plugins/category::category.name')), route('category.index'));
    }

    public function index(CategoryTable $table)
    {
        $this->pageTitle(trans('plugins/category::category.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/category::category.create'));

        return CategoryForm::create()->renderForm();
    }

    public function store(CategoryRequest $request)
    {
        $form = CategoryForm::create()->setRequest($request);

        $form->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('category.index'))
            ->setNextUrl(route('category.edit', $form->getModel()->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(Category $category)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $category->name]));

        return CategoryForm::createFromModel($category)->renderForm();
    }

    public function update(Category $category, CategoryRequest $request)
    {
        CategoryForm::createFromModel($category)
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('category.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(Category $category)
    {
        return DeleteResourceAction::make($category);
    }
}

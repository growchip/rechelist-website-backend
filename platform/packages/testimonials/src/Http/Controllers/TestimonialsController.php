<?php

namespace Botble\Testimonials\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Testimonials\Http\Requests\TestimonialsRequest;
use Botble\Testimonials\Models\Testimonials;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Testimonials\Tables\TestimonialsTable;
use Botble\Testimonials\Forms\TestimonialsForm;

class TestimonialsController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans(trans('packages/testimonials::testimonials.name')), route('testimonials.index'));
    }

    public function index(TestimonialsTable $table)
    {
        $this->pageTitle(trans('packages/testimonials::testimonials.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('packages/testimonials::testimonials.create'));

        return TestimonialsForm::create()->renderForm();
    }

    public function store(TestimonialsRequest $request)
    {
        $form = TestimonialsForm::create()->setRequest($request);

        $form->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('testimonials.index'))
            ->setNextUrl(route('testimonials.edit', $form->getModel()->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(Testimonials $testimonials)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $testimonials->name]));

        return TestimonialsForm::createFromModel($testimonials)->renderForm();
    }

    public function update(Testimonials $testimonials, TestimonialsRequest $request)
    {
        TestimonialsForm::createFromModel($testimonials)
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('testimonials.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(Testimonials $testimonials)
    {
        return DeleteResourceAction::make($testimonials);
    }
    
    
    
}

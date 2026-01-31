<?php

namespace Botble\Testimonials\Http\Controllers\Settings;

use Botble\Base\Forms\FormBuilder;
use Botble\Testimonials\Forms\Settings\TestimonialsForm;
use Botble\Testimonials\Http\Requests\Settings\TestimonialsRequest;
use Botble\Setting\Http\Controllers\SettingController;

class TestimonialsController extends SettingController
{
    public function edit(FormBuilder $formBuilder)
    {
        $this->pageTitle('Page title');

        return $formBuilder->create(TestimonialsForm::class)->renderForm();
    }

    public function update(TestimonialsRequest $request)
    {
        return $this->performUpdate($request->validated());
    }
}

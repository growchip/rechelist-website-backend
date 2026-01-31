<?php

namespace Botble\Testimonials\Forms\Settings;

use Botble\Testimonials\Http\Requests\Settings\TestimonialsRequest;
use Botble\Setting\Forms\SettingForm;

class TestimonialsForm extends SettingForm
{
    public function buildForm(): void
    {
        parent::buildForm();

        $this
            ->setSectionTitle('Setting title')
            ->setSectionDescription('Setting description')
            ->setValidatorClass(TestimonialsRequest::class);
    }
}

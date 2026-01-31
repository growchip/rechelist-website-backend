<?php

namespace Botble\Testimonials\Forms;

use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\Testimonials\Http\Requests\TestimonialsRequest;
use Botble\Testimonials\Models\Testimonials;

class TestimonialsForm extends FormAbstract
{
    public function setup(): void
    {
        $this
    ->setupModel(new Testimonials)
    ->withCustomFields()
    ->add('name', 'text', [
        'label' => 'Name',
        'required' => true,
    ])
    ->add('company', 'text', [
        'label' => 'Company',
        'required' => true,
    ])
    ->add('photo', 'mediaImage', [
        'label' => 'Photo',
    ])
    ->add('message', 'textarea', [
        'label' => 'Message',
        'required' => true,
    ])
    ->add('status', 'customSelect', [
        'label' => 'Status',
        'choices' => [
            'published' => 'Published',
            'draft' => 'Draft',
        ],
    ]);

    }
}

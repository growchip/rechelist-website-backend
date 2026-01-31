<?php

return [
    [
        'name' => 'Testimonials',
        'flag' => 'testimonials.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'testimonials.create',
        'parent_flag' => 'testimonials.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'testimonials.edit',
        'parent_flag' => 'testimonials.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'testimonials.destroy',
        'parent_flag' => 'testimonials.index',
    ],
];

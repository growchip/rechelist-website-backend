<?php

return [
    [
        'name' => 'Categories',
        'flag' => 'category.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'category.create',
        'parent_flag' => 'category.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'category.edit',
        'parent_flag' => 'category.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'category.destroy',
        'parent_flag' => 'category.index',
    ],
];

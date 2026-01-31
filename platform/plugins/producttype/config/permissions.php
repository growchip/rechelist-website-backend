<?php

return [
    [
        'name' => 'Producttypes',
        'flag' => 'producttype.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'producttype.create',
        'parent_flag' => 'producttype.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'producttype.edit',
        'parent_flag' => 'producttype.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'producttype.destroy',
        'parent_flag' => 'producttype.index',
    ],
];

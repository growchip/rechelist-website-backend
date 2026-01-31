<?php
if (!function_exists('get_all_posts')) {
    function get_all_posts($limit = 10, array $with = ['slugable', 'categories'])
    {
        return app(\Botble\Blog\Repositories\Interfaces\PostInterface::class)
            ->advancedGet([
                'condition' => ['status' => \Botble\Base\Enums\BaseStatusEnum::PUBLISHED],
                'order_by'  => ['created_at' => 'desc'], // 👈 newest first
                'take'      => $limit,
                'with'      => $with,
            ]);
    }
}
?>

<?php

namespace Botble\Testimonials\Providers;

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Testimonials\Models\Testimonials;
use Botble\LanguageAdvanced\Supports\LanguageAdvancedManager;

class TestimonialsServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('packages/testimonials')
            ->loadHelpers()
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes();

        if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
            LanguageAdvancedManager::registerModule(Testimonials::class, [
                'name',
            ]);
        }

        DashboardMenu::default()->beforeRetrieving(function () {
            DashboardMenu::registerItem([
                'id' => 'cms-packages-testimonials',
                'priority' => 5,
                'parent_id' => null,
                'name' => 'packages/testimonials::testimonials.name',
                'icon' => 'ti ti-box',
                'url' => route('testimonials.index'),
                'permissions' => ['testimonials.index'],
            ]);
        });
    }
}

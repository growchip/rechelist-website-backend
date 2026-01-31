<?php

namespace Botble\Testimonials\PanelSections;

use Botble\Base\PanelSections\PanelSection;

class TestimonialsPanelSection extends PanelSection
{
    public function setup(): void
    {
        $this
            ->setId('settings.{id}')
            ->setTitle('{title}')
            ->withItems([
                //
            ]);
    }
}

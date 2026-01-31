<?php

namespace Botble\ProductType;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Schema::dropIfExists('Producttypes');
        Schema::dropIfExists('Producttypes_translations');
    }
}

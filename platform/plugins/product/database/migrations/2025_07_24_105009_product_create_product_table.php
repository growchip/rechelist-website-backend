<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();               
                $table->string('title', 255);
                $table->text('desc')->nullable();
                $table->text('brand_name')->nullable();
                $table->text('combination')->nullable();
                $table->string('image')->nullable();
                $table->text('pack')->nullable();
                $table->decimal('mrp', 8, 2)->nullable();
                $table->string('status', 60)->default('published');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('products_translations')) {
            Schema::create('products_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->foreignId('products_id');
                $table->string('name', 255)->nullable();

                $table->primary(['lang_code', 'products_id'], 'products_translations_primary');
            });
        }
    }


    // https://chatgpt.com/share/6882121d-8b2c-8003-bb7c-3aa1114c370f
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('products_translations');
    }
};

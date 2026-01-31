<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    { 
        if (! Schema::hasTable('producttypes')) {
            Schema::create('producttypes', function (Blueprint $table) {
                $table->id();
                $table->string('name', 255);
                $table->text('desc')->nullable();
                $table->text('short_desc')->nullable();
                $table->string('image')->nullable(); // nullable if not always required
                $table->string('status', 60)->default('published');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('producttypes_translations')) {
            Schema::create('producttypes_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->foreignId('producttypes_id');
                $table->string('name', 255)->nullable();

                $table->primary(['lang_code', 'producttypes_id'], 'producttypes_translations_primary');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('producttypes');
        Schema::dropIfExists('producttypes_translations');
    }
};

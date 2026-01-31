<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('prod_category', function (Blueprint $table) {
        $table->string('seo_title')->nullable();
        $table->text('seo_description')->nullable();
        $table->string('seo_image')->nullable();
        $table->string('banner_image')->nullable();
    });
}

public function down()
{
    Schema::table('prod_category', function (Blueprint $table) {
        $table->dropColumn(['seo_title', 'seo_description', 'seo_image', 'banner_image']);
    });
}

};

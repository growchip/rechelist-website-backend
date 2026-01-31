<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('product_category_product')) {
            Schema::create('product_category_product', function (Blueprint $table) {
                $table->unsignedBigInteger('product_id');
                $table->unsignedBigInteger('product_category_id');
                $table->timestamps();

                // Composite primary key
                $table->primary(['product_id', 'product_category_id']);

                // Foreign key: product_id → products(id)
                $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete('cascade');

                // Foreign key: product_category_id → prod_category(id)
                $table->foreign('product_category_id')
                    ->references('id')
                    ->on('prod_category')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_category_product');
    }
};

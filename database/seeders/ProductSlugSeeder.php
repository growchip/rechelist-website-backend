<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Botble\Product\Models\Product;
use Illuminate\Support\Facades\Log;
class ProductSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

            $products = Product::where(function ($query) {
            $query->whereNull('slug')
                ->orWhere('slug', '');
        })->get();

        Log::info("Starting slug generation for {$products->count()} products...");

        foreach ($products as $product) {
            try {
                if ($product->composition) {
                    Log::warning("❌ Product ID {$product->id} has empty composition.");
                    Log::info(['composition' => $product->composition]);
                    continue;
                }

                // Base slug from composition
                $baseSlug = Str::slug($product->composition);
                if (empty($baseSlug)) {
                    Log::info(['slug' => $baseSlug, 'composition' => $product->composition]);
                    Log::warning("⚠️ Could not generate slug from composition for product ID {$product->id}: [{$product->composition}]");
                    continue;
                }

                $slug = $baseSlug;
                $i = 1;

                // Ensure slug is unique
                while (
                    Product::where('slug', $slug)
                        ->where('id', '!=', $product->id)
                        ->exists()
                ) {
                    $slug = $baseSlug . '-' . $i;
                    $i++;
                }

                $product->slug = $slug;

                if ($product->isDirty('slug')) {
                    $product->save();
                    Log::info("✅ Slug generated for product ID {$product->id}: {$slug}");
                } else {
                    Log::info("ℹ️ Product ID {$product->id} slug unchanged.");
                }

            } catch (\Exception $e) {
                Log::error("💥 Error processing product ID {$product->id}: " . $e->getMessage());
            }
        }

    
    
    }
}

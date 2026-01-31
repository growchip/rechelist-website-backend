<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Botble\Product\Models\Product;
use Illuminate\Support\Facades\Log;

class GenerateSlugs extends Command
{
 
    protected $signature = 'generate:slugs {--offset=0} {--limit=60}';

    protected $description = 'Generate missing slugs for products in batches';

    public function handle()
    {
        $offset = (int) $this->option('offset');
        $limit = (int) $this->option('limit');

        $this->info("Processing products with offset {$offset} and limit {$limit}...");

        $products = Product::where(function ($query) {
                $query->whereNull('slug')->orWhere('slug', '');
            })
            ->whereNotNull('combination')
            ->orderBy('id')
            ->offset($offset)
            ->limit($limit)
            ->get();

        if ($products->isEmpty()) {
            $this->info("✅ No more products left to process.");
            return 0;
        }

        foreach ($products as $product) {
            try {
                $baseSlug = Str::slug($product->combination);
                if (empty($baseSlug)) {
                    Log::warning("⚠️ Empty slug for product ID {$product->id}");
                    continue;
                }

                $slug = $baseSlug;
                $i = 1;
                
                while (
                    Product::where('slug', $slug)
                        ->where('id', '!=', $product->id)
                        ->exists()
                ) {
                    $slug = $baseSlug . '-' . $i;
                    $i++;
                }

                $product->slug = $slug;
                $product->save();

                Log::info("✅ Slug generated for product ID {$product->id}: {$slug}");
            } catch (\Exception $e) {
                Log::error("💥 Error for product ID {$product->id}: " . $e->getMessage());
            }
        }

        $this->info("✅ Batch completed.");
    }
}

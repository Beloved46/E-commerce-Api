<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    
        User::factory(1000)->create();
        Category::factory(10)->create();
        Product::factory(200)->create()->each(
            function($product){
                $categories = Category::all()->random(mt_rand(1,5))->pluck('id');

                $product->categories()->attach($categories);
            }
        );
        Transaction::factory(200)->create();
    }
}

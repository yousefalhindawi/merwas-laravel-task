<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\Sub_category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(10)->has(Sub_category::factory(3),'sub_categories')->create();
        // \App\Models\Category::All()->hasProducts(3)->create();

        \App\Models\Category::All()->each(
            function ($Category) {
                $Category->products()->makeMany(\App\Models\Product::factory(3)->create()->toArray());
            }
        );
        \App\Models\Cart::factory(10)->create();
        \App\Models\Order::factory(10)->create();


        // \App\Models\Category::factory(10)->has(Sub_category::factory(3),'sub_categories')->create()->each(
        //     function ($Category) {
        //         $Category->products()->save(
        //             \App\Models\Product::factory(3)->create()
        //         );
        //     }
        // );
        // \App\Models\User::All()->each(
        //     function ($user) {
        //         $user->products()->attach(\App\Models\Product::factory()->create());
        //     }
        // );
        // \App\Models\User::factory(10)->hasProducts(3)->create();
        // \App\Models\Category::factory(10)->hasProducts(3)->create();
        // \App\Models\Sub_category::factory(10)->create();
    }
}

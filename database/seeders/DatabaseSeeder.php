<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Insert basic product
        DB::table('products')->insert(
            array(
                'name' => 'Black t-shirt',
                'slug' => 'black-t-shirt',
                'price' => 4.99,
                'description' => 'A basic plain black t-shirt.',
                'sku' => 'XYZ12345'
            )
        );

        // Insert basic img
        DB::table('product_images')->insert(
            array(
                'name' => 'test.png',
                'path' => 'img',
                'alt' => 'black t-shirt',
                'product_id' => 1
            )
        );

        // Insert basic img
        DB::table('product_images')->insert(
            array(
                'name' => 'test2.jpg',
                'path' => 'img',
                'alt' => 'black t-shirt 2',
                'product_id' => 1
            )
        );
    }
}

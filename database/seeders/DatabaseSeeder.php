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

        // Insert needed attributes
        DB::table('attributes')->insert([
            [
                'name' => 'Size',
                'slug' => 'size'
            ],
            [
                'name' => 'Color',
                'slug' => 'color'
            ],
            [
                'name' => 'Gender',
                'slug' => 'gender'
            ],
            [
                'name' => 'Category',
                'slug' => 'category'
            ]
        ]);

        // Insert values to attrs
        DB::table('attribute_values')->insert([
            [
                'attribute_id' => 1,
                'value' => 'S'
            ],
            [
                'attribute_id' => 1,
                'value' => 'M'
            ],
            [
                'attribute_id' => 1,
                'value' => 'L'
            ],
            [
                'attribute_id' => 1,
                'value' => 'XL'
            ],
            [
                'attribute_id' => 1,
                'value' => 'XXL'
            ],
            [
                'attribute_id' => 2,
                'value' => 'Black'
            ],
            [
                'attribute_id' => 2,
                'value' => 'Blue'
            ],
            [
                'attribute_id' => 2,
                'value' => 'Green'
            ],
            [
                'attribute_id' => 2,
                'value' => 'Red'
            ],
            [
                'attribute_id' => 3,
                'value' => 'Male'
            ],
            [
                'attribute_id' => 3,
                'value' => 'Female'
            ],
            [
                'attribute_id' => 4,
                'value' => 'T-Shirt'
            ],
            [
                'attribute_id' => 4,
                'value' => 'Hoodie'
            ],
            [
                'attribute_id' => 4,
                'value' => 'Jeans'
            ],
            [
                'attribute_id' => 4,
                'value' => 'Sneakers'
            ]
        ]);

        // Insert basic product
        DB::table('products')->insert(
            [
                'name' => 'Black t-shirt',
                'slug' => 'black-t-shirt',
                'price' => 4.99,
                'description' => 'A basic plain black t-shirt.',
                'sku' => 'XYZ12345',
                'created_at' => \DateTime::createFromFormat('U', mt_rand(1262055681,1681522096))
            ]
        );

        // Insert basic img
        DB::table('product_images')->insert(
            [
                'name' => 'test.png',
                'path' => 'img',
                'alt' => 'black t-shirt',
                'product_id' => 1
            ]
        );

        // Insert basic img
        DB::table('product_images')->insert(
            [
                'name' => 'test2.jpg',
                'path' => 'img',
                'alt' => 'black t-shirt 2',
                'product_id' => 1
            ]
        );

        // Insert basic product
        DB::table('products')->insert(
            [
                'name' => 'Blue t-shirt',
                'slug' => 'blue-t-shirt',
                'price' => 18.99,
                'description' => 'A basic plain blue t-shirt.',
                'sku' => 'XYZ12357',
                'created_at' => \DateTime::createFromFormat('U', mt_rand(1262055681,1681522096))
            ]
        );

        // Insert basic img
        DB::table('product_images')->insert(
            [
                'name' => 'blue-tshirt.png',
                'path' => 'img',
                'alt' => 'blue t-shirt',
                'product_id' => 2
            ]
        );

        // Insert basic product
        DB::table('products')->insert(
            [
                'name' => 'Red hoodie',
                'slug' => 'red-hoodie',
                'price' => 48.99,
                'description' => 'A basic plain red hoodie.',
                'sku' => 'XYZ45628',
                'created_at' => \DateTime::createFromFormat('U', mt_rand(1262055681,1681522096))
            ]
        );

        // Insert basic img
        DB::table('product_images')->insert(
            [
                'name' => 'red-hoodie.png',
                'path' => 'img',
                'alt' => 'red hoodie',
                'product_id' => 3
            ]
        );

        // Link products to attributes
        DB::table('attribute_value_product')->insert([
            [
                'product_id' => 1,
                'attribute_value_id' => 1,
            ],
            [
                'product_id' => 1,
                'attribute_value_id' => 2,
            ],
            [
                'product_id' => 1,
                'attribute_value_id' => 3,
            ],
            [
                'product_id' => 1,
                'attribute_value_id' => 6,
            ],
            [
                'product_id' => 1,
                'attribute_value_id' => 10,
            ],
            [
                'product_id' => 1,
                'attribute_value_id' => 12,
            ],
            [
                'product_id' => 2,
                'attribute_value_id' => 7,
            ],
            [
                'product_id' => 2,
                'attribute_value_id' => 10,
            ],
            [
                'product_id' => 2,
                'attribute_value_id' => 12,
            ],
            [
                'product_id' => 3,
                'attribute_value_id' => 5,
            ],
            [
                'product_id' => 3,
                'attribute_value_id' => 9,
            ],
            [
                'product_id' => 3,
                'attribute_value_id' => 11,
            ],
            [
                'product_id' => 3,
                'attribute_value_id' => 13,
            ]
        ]);
    }
}

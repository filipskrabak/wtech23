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
                'value' => 'Men'
            ],
            [
                'attribute_id' => 3,
                'value' => 'Women'
            ],
            [
                'attribute_id' => 4,
                'value' => 'T-Shirts'
            ],
            [
                'attribute_id' => 4,
                'value' => 'Hoodies'
            ],
            [
                'attribute_id' => 4,
                'value' => 'Jeans'
            ],
            [
                'attribute_id' => 4,
                'value' => 'Jackets'
            ],
            [
                'attribute_id' => 4,
                'value' => 'Shirts'
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
                'path' => 'img/upload',
                'alt' => 'black t-shirt',
                'product_id' => 1
            ]
        );

        // Insert basic img
        DB::table('product_images')->insert(
            [
                'name' => 'test2.jpg',
                'path' => 'img/upload',
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
                'path' => 'img/upload',
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
                'path' => 'img/upload',
                'alt' => 'red hoodie',
                'product_id' => 3
            ]
        );

        //New stuff
        DB::table('products')->insert(
            [
                'name' => 'Black hoodie',
                'slug' => 'black-hoodie',
                'price' => 49.99,
                'description' => 'A basic plain black hoodie.',
                'sku' => 'XYZ66666',
                'created_at' => \DateTime::createFromFormat('U', mt_rand(1262055681,1681522096))
            ]
        );

        // Insert basic img
        DB::table('product_images')->insert(
            [
                'name' => 'black-hoodie.png',
                'path' => 'img/upload',
                'alt' => 'black hoodie',
                'product_id' => 4
            ]
        );

        DB::table('products')->insert(
            [
                'name' => 'Black jacket',
                'slug' => 'black-jacket',
                'price' => 88.99,
                'description' => 'A basic plain black jacket.',
                'sku' => 'XYZ77777',
                'created_at' => \DateTime::createFromFormat('U', mt_rand(1262055681,1681522096))
            ]
        );

        // Insert basic img
        DB::table('product_images')->insert(
            [
                'name' => 'black-jacket.png',
                'path' => 'img/upload',
                'alt' => 'black jacket',
                'product_id' => 5
            ]
        );

        DB::table('products')->insert(
            [
                'name' => 'Blue jeans',
                'slug' => 'blue-jeans',
                'price' => 33.99,
                'description' => 'A basic plain blue jeans.',
                'sku' => 'XYZ88888',
                'created_at' => \DateTime::createFromFormat('U', mt_rand(1262055681,1681522096))
            ]
        );

        // Insert basic img
        DB::table('product_images')->insert(
            [
                'name' => 'blue-jeans.png',
                'path' => 'img/upload',
                'alt' => 'blue jeans',
                'product_id' => 6
            ]
        );

        DB::table('products')->insert(
            [
                'name' => 'Black shirt',
                'slug' => 'black-shirt',
                'price' => 36.99,
                'description' => 'A basic plain black shirt.',
                'sku' => 'XYZ99999',
                'created_at' => \DateTime::createFromFormat('U', mt_rand(1262055681,1681522096))
            ]
        );

        // Insert basic img
        DB::table('product_images')->insert(
            [
                'name' => 'shirt.png',
                'path' => 'img/upload',
                'alt' => 'black shirt',
                'product_id' => 7
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
                'attribute_value_id' => 3,
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
            ],
            //HERE
            [
                'product_id' => 4,
                'attribute_value_id' => 1,
            ],
            [
                'product_id' => 4,
                'attribute_value_id' => 2,
            ],
            [
                'product_id' => 4,
                'attribute_value_id' => 3,
            ],
            [
                'product_id' => 4,
                'attribute_value_id' => 6,
            ],
            [
                'product_id' => 4,
                'attribute_value_id' => 10,
            ],
            [
                'product_id' => 4,
                'attribute_value_id' => 13,
            ],
            [
                'product_id' => 5,
                'attribute_value_id' => 1,
            ],
            [
                'product_id' => 5,
                'attribute_value_id' => 2,
            ],
            [
                'product_id' => 5,
                'attribute_value_id' => 3,
            ],
            [
                'product_id' => 5,
                'attribute_value_id' => 6,
            ],
            [
                'product_id' => 5,
                'attribute_value_id' => 11,
            ],
            [
                'product_id' => 5,
                'attribute_value_id' => 15,
            ],
            [
                'product_id' => 6,
                'attribute_value_id' => 1,
            ],
            [
                'product_id' => 6,
                'attribute_value_id' => 2,
            ],
            [
                'product_id' => 6,
                'attribute_value_id' => 3,
            ],
            [
                'product_id' => 6,
                'attribute_value_id' => 7,
            ],
            [
                'product_id' => 6,
                'attribute_value_id' => 11,
            ],
            [
                'product_id' => 6,
                'attribute_value_id' => 14,
            ],
            [
                'product_id' => 7,
                'attribute_value_id' => 1,
            ],
            [
                'product_id' => 7,
                'attribute_value_id' => 2,
            ],
            [
                'product_id' => 7,
                'attribute_value_id' => 3,
            ],
            [
                'product_id' => 7,
                'attribute_value_id' => 6,
            ],
            [
                'product_id' => 7,
                'attribute_value_id' => 10,
            ],
            [
                'product_id' => 7,
                'attribute_value_id' => 16,
            ]
        ]);

        DB::table('countries')->insert([
            'name' => 'Slovensko'
        ]);

        DB::table('regions')->insert([
            'name' => 'Bratislavský kraj',
            'country_id' => 1
        ]);

        DB::table('cities')->insert([
            'name' => 'Bratislava',
            'region_id' => 1
        ]);

        DB::table('districts')->insert([
            'name' => 'Petržalka',
            'city_id' => 1
        ]);

        DB::table('postcodes')->insert([
            'postcode' => '851 01',
            'district_id' => 1
        ]);

        DB::table('postcodes')->insert([
            'postcode' => '851 04',
            'district_id' => 1
        ]);

        DB::table('streets')->insert([
            'name' => 'Andrusovova',
            'house_number' => 11,
            'district_id' => 1
        ]);

        DB::table('streets')->insert([
            'name' => 'A. Gwerkovej',
            'house_number' => 15,
            'district_id' => 1
        ]);
    }
}

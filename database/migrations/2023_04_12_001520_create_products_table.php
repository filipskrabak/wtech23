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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 32);
            $table->string('slug', 32);
            $table->double('price');
            $table->string('description', 512);
            $table->string('sku', 8);
            $table->timestamps();
        });

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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

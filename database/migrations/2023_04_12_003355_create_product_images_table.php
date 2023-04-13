<?php

use App\Models\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->string('path', 64);
            $table->string('alt', 64);
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};

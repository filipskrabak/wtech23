<?php

use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('name', 32);
            $table->string('surname',32)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('email', 96)->unique();
            $table->string('street', 128);
            $table->string('postcode',16);
            $table->string('city', 128);
            $table->string('country', 128);
            $table->double('price');
            $table->string('status', 32);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

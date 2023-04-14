<?php

use App\Models\Postcode;
use App\Models\Street;
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
        Schema::create('users', function (Blueprint $table) {
            // TODO: add address
            $table->id();
            $table->string('name',32)->nullable();
            $table->string('surname',32)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('email', 96)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('role')->default(0);
            $table->foreignIdFor(Street::class)->nullable()->constrained();
            $table->foreignIdFor(Postcode::class)->nullable()->constrained();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

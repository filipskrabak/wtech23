<?php

use App\Models\Variant;
use App\Models\AttributeValue;
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
        Schema::create('variants_attributes_values', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Variant::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(AttributeValue::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants_attributes_values');
    }
};

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
        Schema::create('form_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained(
                table: 'shops', indexName: 'shop_id'
            );
            $table->string('form_name', 50);
            $table->integer('option_display_count')->default(5);
            $table->integer('min_delivery_date_offset')->default(3);
            $table->binary('countries_shift_min_delivery_date_offset')->nullable(true);
            $table->boolean('shift_min_delivery_date_offset_after_3pm')->default(0);
            $table->boolean('saturday_delivery_disabled')->default(0);
            $table->boolean('sunday_delivery_disabled')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_settings');
    }
};

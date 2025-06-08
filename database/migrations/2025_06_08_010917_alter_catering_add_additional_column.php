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
        Schema::table('vendor_caterings', function (Blueprint $table) {
            $table->integer('buffet_price')->nullable();
            $table->integer('gubugan_price')->nullable();
            $table->integer('dessert_price')->nullable();
            $table->integer('base_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

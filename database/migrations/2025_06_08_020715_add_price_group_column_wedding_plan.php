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
        Schema::table('wedding_transactions', function (Blueprint $table) {
            $table->integer('catering_total_price')->nullable();
            $table->integer('total_buffet_price')->nullable();
            $table->integer('total_gubugan_price')->nullable();
            $table->integer('total_dessert_price')->nullable();
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

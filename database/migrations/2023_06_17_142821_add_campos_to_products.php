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
        Schema::table('products', function (Blueprint $table) {
            $table->string('iva')->nullable();
            $table->string('costo_total')->nullable();
            $table->string('margen')->nullable();
            $table->string('utilidad')->nullable();
            $table->string('costo_fijo')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('iva_pa')->nullable();
            $table->string('total')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};

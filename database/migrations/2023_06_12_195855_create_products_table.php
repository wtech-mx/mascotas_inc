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
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->text('sku')->nullable();
            $table->text('stock')->nullable();
            $table->text('alerta_stock')->nullable();

            $table->unsignedBigInteger('id_categoria');
            $table->foreign('id_categoria')
                ->references('id')->on('categorias')
                ->inDelete('set null');

            $table->float('precio_rebajado')->nullable();
            $table->float('precio_normal');
            $table->text('imagen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbproduto', function (Blueprint $table) {
            $table->id();
            $table->string('nomeProduto');
            $table->decimal('precoProduto', 10, 2);
            $table->unsignedBigInteger('categoria_id');
            $table->timestamps();

            $table->foreign('categoria_id')
                ->references('id')
                ->on('tbcategorias')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbproduto');
    }
};

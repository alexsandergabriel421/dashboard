<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbvendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->integer('quantidade');
            $table->decimal('valorTotal', 10, 2)->nullable();
            $table->date('dataVenda');
            $table->timestamps();

            // FK apontando para a tabela correta (tbproduto)
            $table->foreign('produto_id')
                ->references('id')
                ->on('tbproduto')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbvendas');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbfuncionario', function (Blueprint $table) {
            $table->id();
            $table->string('nomeFuncionario');
            $table->string('cargoFuncionario');
            $table->decimal('salarioFuncionario', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbfuncionario');
    }
};

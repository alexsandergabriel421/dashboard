<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // MariaDB (XAMPP) não suporta RENAME COLUMN → usar CHANGE
        DB::statement("
            ALTER TABLE tbproduto 
            CHANGE precoProduto preco DECIMAL(10,2) NOT NULL
        ");
    }

    public function down()
    {
        DB::statement("
            ALTER TABLE tbproduto 
            CHANGE preco precoProduto DECIMAL(10,2) NOT NULL
        ");
    }
};

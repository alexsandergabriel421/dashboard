<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'tbproduto';

    protected $fillable = [
        'nomeProduto',
        'precoProduto',
        'categoria'
    ];

    public function vendas()
    {
        return $this->hasMany(Venda::class, 'idProduto');
    }
}

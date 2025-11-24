<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'tbproduto';

    protected $fillable = [
        'nome',
        'preco',
        'categoria',
        'descricao',
    ];

    public function vendas()
    {
        return $this->hasMany(Venda::class, 'produto_id'); // CORRETO
    }
}

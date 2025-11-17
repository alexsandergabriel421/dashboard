<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    // NOME CORRETO DA TABELA
    protected $table = 'tbvendas';

    protected $fillable = [
        'idProduto',
        'quantidade',
        'valorTotal',
        'dataVenda'
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'idProduto', 'id');
    }
}

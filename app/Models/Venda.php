<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = "tbvendas";

    protected $fillable = [
        'produto_id',
        'quantidade',
        'valorTotal',
        'dataVenda',
    ];

    // Faz o Laravel CONVERTER automaticamente dataVenda em Carbon
    protected $casts = [
        'dataVenda' => 'date',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}

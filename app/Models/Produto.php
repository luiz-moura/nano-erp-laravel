<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'categoria_id',
        'codigo_barras',
        'nome',
        'marca',
        'ultimo_valor_custo',
        'valor_venda'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class)->withDefault();
    }

    public function lancamentoTemProdutos()
    {
        return $this->hasMany(LancamentoTemProduto::class);
    }

    public function lancamentos()
    {
        return $this
            ->belongsToMany(Lancamento::class, 'lancamento_tem_produtos')
            ->using(LancamentoTemProduto::class)
            ->withPivot('id', 'quantidade', 'preco_unitario')
            ->wherePivotNull('deleted_at');
    }
}

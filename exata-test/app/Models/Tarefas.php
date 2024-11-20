<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\StatusTarefa;

class Tarefas extends Model
{
    public $timestamps = false;

    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'status',
        'data_criacao',
        'data_modificacao',
        'user_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Transforma os dados da coluna status para o tipo StatusTarefa(ENUM)
    protected $casts = [
        'status' => StatusTarefa::class,
    ];
}

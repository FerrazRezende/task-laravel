<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\StatusTarefa;

class Tarefas extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'status',
        'data_criacao',
        'data_modificacao',
        'data_conclusao',
        'user_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $casts = [
        'status' => StatusTarefa::class,
    ];
}

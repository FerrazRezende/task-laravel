<?php

namespace App\Enums;

enum StatusTarefa: string {
    case PENDENTE = 'Pendente';
    case EM_ANDAMENTO = 'Em andamento';
    case CONCLUIDO = 'Concluido';


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

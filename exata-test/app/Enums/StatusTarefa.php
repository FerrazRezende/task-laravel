<?php

namespace App\Enums;

enum StatusTarefa: string {
    case EM_ABERTO = 'Em aberto';
    case EM_ANDAMENTO = 'Em andamento';
    case CONCLUIDO = 'Concluido';


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

<?php

namespace App\Enums;

enum TicketPriority: string
{
    case Baixa = 'baixa';
    case Media = 'media';
    case Alta = 'alta';
    case Urgente = 'urgente';
}

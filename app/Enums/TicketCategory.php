<?php

namespace App\Enums;

enum TicketCategory: string {
    case Geral = 'geral';
    case Hardware = 'hardware';
    case Software = 'software';
    case Rede = 'rede';
}

<?php

namespace App\Models\Enums;

enum RoomStatus: string
{
        case AVAILABLE = 'AVAILABLE';
        case IN_USE = 'IN_USE';
        case MAINTENANCE = 'MAINTENANCE';
}

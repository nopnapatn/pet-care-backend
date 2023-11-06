<?php

namespace App\Models\Enums;

enum RoomStatus: string
{
        case AVAILABLE = 'AVAILABLE';
        case INUSE = 'IN_USE';
        case MAINTENANCE = 'MAINTENANCE';
}

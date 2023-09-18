<?php

namespace App\Models\Enums;

enum HotelStatus: string
{
    case AVAILABLE = 'AVAILABLE';
    case UNAVAILABLE = 'UNAVAILABLE';
}

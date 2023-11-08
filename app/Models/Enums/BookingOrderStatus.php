<?php

namespace App\Models\Enums;

enum BookingOrderStatus: string
{
    case WAITING = 'WAITING';
    case PENDING = 'PENDING';
    case VERIFIED = 'VERIFIED';
    case IN_USE = 'IN_USE';
    case COMPLETED = 'COMPLETED';
}

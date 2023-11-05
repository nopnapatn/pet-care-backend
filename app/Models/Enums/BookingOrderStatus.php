<?php

namespace App\Models\Enums;

enum BookingOrderStatus: string
{
        // case BOOKED = 'BOOKED';
        // case CHECKED_IN = 'CHECKED_IN';
        // case CHECKED_OUT = 'CHECKED_OUT';
    case WAITING = 'WAITING';
    case PENDING = 'PENDING';
    case VERIFIED = 'VERIFIED';
    case IN_USE = 'IN_USE';
    case COMPLETED = 'COMPLETED';
}

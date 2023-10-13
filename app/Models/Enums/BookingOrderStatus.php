<?php

namespace App\Models\Enums;

enum BookingOrderStatus: string
{
    case BOOKED = 'BOOKED';
    case CHECKED_IN = 'CHECKED_IN';
    case CHECKED_OUT = 'CHECKED_OUT';
}

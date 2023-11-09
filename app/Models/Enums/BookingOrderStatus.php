<?php

namespace App\Models\Enums;

enum BookingOrderStatus: string
{
    case WAITING = 'WAITING';
    case PENDING = 'PENDING';
    case VERIFIED = 'VERIFIED';
    case IN_USE = 'IN_USE';
    case COMPLETED = 'COMPLETED';
    case CANCELED = 'CANCELED';

    public static function randomPast()
    {
        $statuses = [
            self::COMPLETED,
            self::IN_USE,
        ];
        return $statuses[array_rand($statuses)];
    }

    public static function randomFuture()
    {
        $statuses = [
            self::CANCELED,
            self::PENDING,
            self::VERIFIED,
            self::WAITING,
        ];
        return $statuses[array_rand($statuses)];
    }
}

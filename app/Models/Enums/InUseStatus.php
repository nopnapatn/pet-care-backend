<?php

namespace App\Models\Enums;

enum InUseStatus: string
{
        case AVAILABLE = 'AVAILABLE';
        case INUSE = 'IN_USE';
}

<?php

namespace App\Models\Enums;

enum MaintenanceStatus: string
{
        case AVAILABLE = 'AVAILABLE';
        case MAINTENANCE = 'MAINTENANCE';
}

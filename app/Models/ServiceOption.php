<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'pet_size',
        'furthur_option',
        'price',
        'up_price_status',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

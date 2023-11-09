<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_name',
        'type',
        'option',
        'breed_size',
        'price',
    ];

    public function serviceOrder()
    {
        return $this->belongsToMany(ServiceOrder::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_item_id',
        'service_date',
        'total_price',
        'pet_type',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function serviceItem()
    {
        return $this->hasMany(ServiceItem::class);
    }
}

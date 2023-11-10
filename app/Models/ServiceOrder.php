<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        // 'service_item_id',
        'service_date',
        'total_price',
        'pet_type',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function serviceItems()
    {
        return $this->belongsToMany(ServiceItem::class, 'service_order_service_items');
    }

    public function serviceOrderServiceItem()
    {
        return $this->hasMany(ServiceOrderServiceItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function calculateTotalPrice()
    {
        // Eager load the serviceItems relationship
        $this->load('serviceItems');

        $totalPrice = 0;

        foreach ($this->serviceItems as $serviceItem) {
            $totalPrice += $serviceItem->price;
        }

        return $totalPrice;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'type', ];

    public function serviceOptions()
    {
        return $this->hasMany(ServiceOption::class);
    }

    public function serviceImages()
    {
        return $this->hasMany(ServiceImage::class);
    }
}

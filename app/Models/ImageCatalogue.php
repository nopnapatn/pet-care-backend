<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageCatalogue extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_url', // Update this to match your database column name
        'image_caption',
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
}

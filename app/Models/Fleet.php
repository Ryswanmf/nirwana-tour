<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'facilities' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function getImageUrlAttribute(): string
    {
        return storage_or_asset($this->image, 'assets/images/armada/big-bus.jpg');
    }
}

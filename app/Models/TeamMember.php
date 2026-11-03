<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function getPhotoUrlAttribute(): string
    {
        return storage_or_asset($this->photo, 'assets/images/pemilik-nirwana.webp');
    }
}

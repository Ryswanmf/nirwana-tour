<?php

namespace App\Models;

use App\Traits\ClearsHomeCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory, ClearsHomeCache;

    protected $guarded = ['id'];

    protected $casts = [
        'is_primary' => 'boolean',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function getCleanWhatsappAttribute(): ?string
    {
        if (empty($this->whatsapp)) {
            return null;
        }

        $num = preg_replace('/[^0-9]/', '', $this->whatsapp);
        if (str_starts_with($num, '0')) {
            $num = '62' . substr($num, 1);
        }

        return $num;
    }

    public function getCleanPhoneAttribute(): ?string
    {
        return preg_replace('/[^0-9]/', '', $this->phone ?? '');
    }

    public function getMapsEmbedSrcAttribute(): ?string
    {
        $raw = $this->google_maps_embed ?? '';
        if (empty($raw)) {
            return null;
        }

        // If admin pastes full <iframe> tag, extract src
        if (preg_match('/src="([^"]+)"/', $raw, $matches)) {
            return $matches[1];
        }

        return $raw;
    }
}

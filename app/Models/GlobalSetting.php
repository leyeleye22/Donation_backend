<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GlobalSetting extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'site_name', 'donation_cta_text', 'show_floating_button',
        'floating_button_pages', 'footer_copyright', 'footer_intro',
        'page_visibility', 'page_settings',
    ];

    protected function casts(): array
    {
        return [
            'show_floating_button' => 'boolean',
            'floating_button_pages' => 'array',
            'page_visibility' => 'array',
            'page_settings' => 'array',
        ];
    }

    protected static function booted(): void
    {
        static::creating(fn (GlobalSetting $gs) => $gs->id ??= (string) Str::uuid());
    }

    public static function singleton(): self
    {
        return self::firstOrCreate([], [
            'site_name' => "Entraide Humanitaire",
            'donation_cta_text' => "Faire un don",
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsletterSubscriber extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'email', 'name', 'is_active', 'subscribed_at',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'subscribed_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(fn (NewsletterSubscriber $s) => $s->id ??= (string) Str::uuid());
    }
}

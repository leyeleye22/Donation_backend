<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EmailTemplate extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name', 'subject', 'content',
    ];

    protected static function booted(): void
    {
        static::creating(fn (EmailTemplate $t) => $t->id ??= (string) Str::uuid());
    }
}

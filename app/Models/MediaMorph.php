<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MediaMorph extends Model
{
    protected $table = 'media_morph';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'media_id', 'mediable_id', 'mediable_type', 'role',
    ];

    protected static function booted(): void
    {
        static::creating(fn (MediaMorph $mm) => $mm->id ??= (string) Str::uuid());
    }

    public function media()
    {
        return $this->belongsTo(GalleryItem::class, 'media_id');
    }

    public function mediable()
    {
        return $this->morphTo();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PageContent extends Model
{
    protected $table = 'page_content';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'page_slug', 'content', 'published_by', 'published_at',
    ];

    protected function casts(): array
    {
        return [
            'content' => 'array',
            'published_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(fn (PageContent $pc) => $pc->id ??= (string) Str::uuid());
    }

    public function publishedBy()
    {
        return $this->belongsTo(User::class, 'published_by');
    }

    public function versions()
    {
        return $this->morphMany(ContentVersion::class, 'versionable');
    }
}

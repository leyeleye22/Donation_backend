<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use SoftDeletes, HasTranslations;

    public $translatable = ['title', 'excerpt', 'content', 'location'];

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'slug', 'title', 'excerpt', 'content', 'image',
        'category', 'location', 'read_time', 'is_published',
        'published_at', 'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(fn (Post $post) => $post->id ??= (string) Str::uuid());
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function versions()
    {
        return $this->morphMany(ContentVersion::class, 'versionable');
    }
}

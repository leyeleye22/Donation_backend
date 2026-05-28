<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['slug', 'name'];

    protected static function booted(): void
    {
        static::creating(fn (Tag $t) => $t->id ??= (string) Str::uuid());
    }

    public function projects()
    {
        return $this->morphedByMany(Project::class, 'taggable');
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }
}

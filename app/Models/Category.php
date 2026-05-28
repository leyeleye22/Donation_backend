<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'description'];

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['slug', 'name', 'description', 'type'];

    protected static function booted(): void
    {
        static::creating(fn (Category $c) => $c->id ??= (string) Str::uuid());
    }

    public function posts()
    {
        return $this->morphMany(Post::class, 'categorizable');
    }

    public function projects()
    {
        return $this->morphMany(Project::class, 'categorizable');
    }
}

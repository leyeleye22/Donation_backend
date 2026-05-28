<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class ProjectUpdate extends Model
{
    use HasTranslations;

    public $translatable = ['content'];

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'project_id', 'title', 'content', 'image', 'type', 'created_by',
    ];

    protected static function booted(): void
    {
        static::creating(fn (ProjectUpdate $u) => $u->id ??= (string) Str::uuid());
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

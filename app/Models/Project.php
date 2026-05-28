<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use SoftDeletes, HasTranslations;

    public $translatable = ['title', 'description', 'location', 'beneficiary_label'];

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'slug', 'theme', 'title', 'description', 'location',
        'beneficiary_label', 'goal_amount', 'collected_amount',
        'status', 'cover_image', 'published_at', 'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'goal_amount' => 'integer',
            'collected_amount' => 'integer',
            'published_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(fn (Project $p) => $p->id ??= (string) Str::uuid());
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function media()
    {
        return $this->morphToMany(GalleryItem::class, 'mediable', 'media_morph')
            ->withPivot('role');
    }

    public function cover()
    {
        return $this->morphOne(GalleryItem::class, 'mediable', 'media_morph')
            ->wherePivot('role', 'cover');
    }

    public function versions()
    {
        return $this->morphMany(ContentVersion::class, 'versionable');
    }

    public function updates()
    {
        return $this->hasMany(ProjectUpdate::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}

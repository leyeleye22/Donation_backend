<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class GalleryItem extends Model
{
    use SoftDeletes, HasTranslations;

    public $translatable = ['title'];

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title', 'file_path', 'file_type', 'categories',
        'file_size', 'mime_type', 'uploaded_by', 'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'categories' => 'array',
            'file_size' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(fn (GalleryItem $item) => $item->id ??= (string) Str::uuid());
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}

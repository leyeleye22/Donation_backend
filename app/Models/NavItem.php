<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class NavItem extends Model
{
    use SoftDeletes, HasTranslations;

    public $translatable = ['label'];

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'sort_order', 'label', 'href', 'is_active', 'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(fn (NavItem $item) => $item->id ??= (string) Str::uuid());
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}

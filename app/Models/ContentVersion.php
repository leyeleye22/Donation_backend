<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ContentVersion extends Model
{
    public $timestamps = false;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'versionable_id', 'versionable_type', 'snapshot',
        'action', 'performed_by',
    ];

    protected function casts(): array
    {
        return [
            'snapshot' => 'array',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (ContentVersion $v) {
            $v->id ??= (string) Str::uuid();
            $v->created_at ??= now();
        });
    }

    public function versionable()
    {
        return $this->morphTo();
    }

    public function performedBy()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}

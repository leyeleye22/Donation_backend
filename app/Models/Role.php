<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['name', 'guard_name', 'permissions'];

    protected function casts(): array
    {
        return [
            'permissions' => 'array',
        ];
    }

    protected static function booted(): void
    {
        static::creating(fn (Role $r) => $r->id ??= (string) Str::uuid());
    }

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}

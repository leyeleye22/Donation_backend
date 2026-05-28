<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Donation extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'project_id', 'donor_name', 'donor_email', 'amount',
        'currency', 'message', 'status', 'payment_method', 'transaction_id',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(fn (Donation $d) => $d->id ??= (string) Str::uuid());
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

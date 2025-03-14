<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @mixin Builder
 *
 * @property string $email
 * @property Carbon $notified_at
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * */
class Email extends Model
{
    use Notifiable;
    use HasFactory;

    /** @var array<int, string> */
    protected $fillable = [
        'email',
        'notified_at'
    ];

    /** @var array<string, string> */
    protected $casts = [
        'notified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function scopeNotNotified(Builder $query): Builder
    {
        return $query->whereNull('notified_at');
    }
}

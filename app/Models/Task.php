<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    const TO_DO = 1;
    const IN_PROGRESS = 2;
    const REVIEW = 3;
    const COMPLETED = 4;

    const status = [
        self::TO_DO => 'To Do',
        self::IN_PROGRESS => 'In Progress',
        self::REVIEW => 'Review',
        self::COMPLETED => 'Completed',
    ];

    protected $fillable = [
        'title',
        'description',
        'startedAt',
        'completedAt',
        'deadline',
        'status',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function statusOptionKeys(): array
    {
        return array_keys(self::status);
    }

    public static function statusLabel(int $status): ?string
    {
        return self::status[$status] ?? 'Unknown Status';
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserTask extends Model
{
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

    protected $table = 'user_task';

    protected $fillable = ['user_id', 'task_id', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
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

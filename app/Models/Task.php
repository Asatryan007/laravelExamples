<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    const status = [
        'to_do' => 'To Do',
        'in_progress' => 'In Progress',
        'review' => 'Review',
        'completed' => 'Completed',
    ];

    protected $fillable = [
        'title',
        'description',
        'startedAt',
        'completedAt',
        'deadline',
        'status',
    ];

    public static function statusOptionValues(): array
    {
        return array_values(self::status);
    }

    public static function statusOptionKeys(): array
    {
        return array_keys(self::status);
    }

    public static function statusLabel(string $status): ?string
    {
        return self::status[$status] ?? null;
    }

}

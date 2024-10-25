<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    const TO_DO = 1;
    const IN_PROGRESS = 2;
    const REVIEW = 3;
    const COMPLETED = 4;


    const status = [
        1 => 'To Do',
        2 => 'In Progress',
        3 => 'Review',
        4 => 'Completed',
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

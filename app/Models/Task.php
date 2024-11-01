<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;



    protected $fillable = [
        'title',
        'description',
        'startedAt',
        'completedAt',
        'deadline',
        'parent_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_task')
            ->withPivot('status', 'deadline') // Include additional pivot fields
            ->withTimestamps();
    }

}

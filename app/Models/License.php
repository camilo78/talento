<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'department_id',
        'reason',
        'boss',
        'beginning',
        'end',
        'days',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}

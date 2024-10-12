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
        'reason_id',
        'boss_id',
        'beginning',
        'end',
        'days',
        'days_h',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
      // Relación con el jefe del departamento
      public function boss()
      {
          return $this->belongsTo(User::class, 'boss_id');
      }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    public function reason()
    {
        return $this->belongsTo(Reason::class);
    }
}

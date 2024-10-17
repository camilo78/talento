<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\License;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Department extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'user_id',
        'parent_id',

    ];

    /**
     * The users that belong to the Department
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_department', 'department_id', 'user_id');
    }

    /**
     * Get the user associated with the Department
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function license(): HasOne
    {
        return $this->hasOne(License::class);
    }

    // Relación con el departamento padre
    public function parent()
    {
        return $this->belongsTo(Department::class, 'parent_id');
    }

    // Relación con los departamentos hijos (subordinados)
    public function children()
    {
        return $this->hasMany(Department::class, 'parent_id');
    }
}

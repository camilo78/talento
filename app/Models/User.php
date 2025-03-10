<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Department;
use App\Models\License;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'gender',
        'email',
        'password',
        'dni',
        'rtn',
        'functional',
        'profession_id',
        'specialty_id',
        'nominal',
        'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The departments that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function departments() {
        return $this->belongsToMany(Department::class, 'user_department');
    }

    /**
     * Get the depart that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department(): HasOne
    {
        return $this->hasOne(Department::class);
    }
    public function license(): HasOne
    {
        return $this->hasOne(License::class);
    }
    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

}

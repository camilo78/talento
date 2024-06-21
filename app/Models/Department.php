<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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
        'user_id'
    ];

    // public function users() {
    //  	return $this->hasMany(User::class);
    // }

    public function boss(): HasOne
    {
        return $this->hasOne(User::class, 'id','user_id');
    }
}

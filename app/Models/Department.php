<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function users() {
    	return $this->hasMany('App\Models\User');
    }
    public function user() {
    	return $this->hasOne('App\Models\User');
    }
}

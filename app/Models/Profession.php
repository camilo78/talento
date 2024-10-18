<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    protected $fillable = ['id','profession', 'specialty','other_studies'];

    // Relación con el modelo User
    public function users()
    {
        return $this->hasMany(User::class);
    }

}

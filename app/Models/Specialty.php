<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    // Especificar los campos que se pueden asignar masivamente
    protected $fillable = [
        'name',             // Nombre de la especialidad
        'profession_id',    // ID de la profesión relacionada
    ];

    // Relación con la tabla de profesiones
    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

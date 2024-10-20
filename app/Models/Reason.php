<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'reason',
        'proof',
        'max_days',
        'max_working_days',
        'type',
    ];

    public function licenses()
    {
        return $this->hasMany(License::class);
    }
}

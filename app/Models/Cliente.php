<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{


    protected $fillable = ['nombre', 'email', 'telefono'];

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }
}

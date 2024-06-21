<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctores';
    
    protected $fillable = [
        'first_name', 'last_name', 'age', 'especialidad_id', 'email', 'password'
    ];

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }
}

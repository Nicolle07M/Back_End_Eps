<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctores';
    
    protected $fillable = [
        'first_name', 'last_name', 'age', 'especialidad_id', 'email', 'password'
    ];

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }
}

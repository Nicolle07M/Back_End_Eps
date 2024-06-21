<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;
    protected $table = 'especialidades';

    protected $fillable = ['name'];

    public function doctores()
    {
        return $this->hasMany(Doctor::class, 'especialidad_id');
    }

}
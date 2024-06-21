<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'age', 'specialty_id', 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }
}
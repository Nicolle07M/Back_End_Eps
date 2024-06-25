<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Especialidad;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'age' => $this->faker->numberBetween(25, 65),
            'especialidad_id' => Especialidad::factory(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // Puedes usar un hash de contraseña adecuado aquí
        ];
    }
}
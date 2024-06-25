<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Doctor;
use App\Models\Especialidad;

class DoctorControllerTest extends TestCase
{
    use RefreshDatabase;

// PRUEBA PARA RETORNAR DOCTORES //
    public function testIndexReturnsDoctors()
    {
        Doctor::factory()->count(3)->create();

        $response = $this->getJson('/api/doctores');

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonStructure([
                '*' => ['id', 'first_name', 'last_name', 'age', 'especialidad_id', 'email']
            ]);
    }

// PRUEBA RETORNAR SI NO HAY DOCTORES //
    public function testIndexReturnsNoDoctors()
    {
        $response = $this->getJson('/api/doctores');

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'No hay no hay doctores',
                'status' => 200
            ]);
    }

    // PRUEBA PARA CREAR UN DOCTOR //
    public function testStoreCreatesDoctor()
    {
        $especialidad = Especialidad::factory()->create();

        $response = $this->postJson('/api/doctores', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'age' => 30,
            'especialidad_id' => $especialidad->id,
            'email' => 'johndoe@example.com',
            'password' => 'secret123'
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Doctor creado correctamente',
                'status' => 201
            ]);

        $this->assertDatabaseHas('doctores', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
        ]);
    }

// PRUEBA PARA ACTUALIZAR DATOS DE UN DOCTOR // 
    public function testUpdateDoctor()
    {
        $doctor = Doctor::factory()->create();
        $especialidad = Especialidad::factory()->create();

        $response = $this->putJson('/api/doctores/' . $doctor->id, [
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'age' => 40,
            'especialidad_id' => $especialidad->id,
            'email' => 'janesmith@example.com',
            'password' => 'newpassword123'
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Doctor actualizado correctamente',
                'status' => 200
            ]);

        $this->assertDatabaseHas('doctores', [
            'id' => $doctor->id,
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'janesmith@example.com',
        ]);
    }

   


}

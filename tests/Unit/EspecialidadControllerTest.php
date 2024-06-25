<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Especialidad;

class EspecialidadControllerTest extends TestCase
{
    use RefreshDatabase; // Utiliza esta trait para resetear la base de datos después de cada prueba

    public function testIndexReturnsEspecialidades()
    {
        Especialidad::factory()->count(3)->create();

        $response = $this->getJson('/api/especialidades');

        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonStructure([
                '*' => ['id', 'name']
            ]);
    }

    public function it_returns_no_especialidades_when_none_exist()
    {
        // Hacer la solicitud para obtener todas las especialidades
        $response = $this->getJson('/api/especialidades');

        // Asegurarse de que la respuesta tenga el código de estado 200 y el mensaje esperado
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'No hay no hay especialidades',
                'status' => 200
            ]);
    }

    public function it_can_create_a_new_especialidad()
    {
        $data = [
            'name' => 'Especialidad de Prueba',
        ];

        // Hacer la solicitud para crear una nueva especialidad
        $response = $this->postJson('/api/especialidades', $data);

        // Asegurarse de que la respuesta tenga el código de estado 201 y el mensaje esperado
        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Especialidad creado correctamente',
                     'status' => 201,
                 ]);

        // Asegurarse de que la especialidad se haya guardado en la base de datos
        $this->assertDatabaseHas('especialidades', ['name' => 'Especialidad de Prueba']);
    }

    public function it_can_update_an_especialidad()
    {
        $especialidad = Especialidad::factory()->create();
        $newData = [
            'name' => 'Updated Especialidad Name',
        ];

        // Hacer la solicitud para actualizar la especialidad
        $response = $this->putJson('/api/especialidades/' . $especialidad->id, $newData);

        // Asegurarse de que la respuesta tenga el código de estado 200 y el mensaje esperado
        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'especialidad actualizada correctamente',
                     'status' => 200,
                 ]);

        // Asegurarse de que la especialidad se haya actualizado en la base de datos
        $this->assertDatabaseHas('especialidades', [
            'id' => $especialidad->id,
            'name' => 'Updated Especialidad Name',
        ]);
    }

}






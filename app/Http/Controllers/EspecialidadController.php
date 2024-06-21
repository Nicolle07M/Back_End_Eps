<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especialidad;
use Illuminate\Support\Facades\Validator;

class EspecialidadController extends Controller
{
    public function index() 
    { 

        $especialidades = Especialidad::all();

        if ($especialidades->isEmpty()) {
            $data = [
                'message' => 'No hay no hay especialidades',
                'status' => 200
            ];
            return response()->json($data, 200);
        }

        return response()->json($especialidades, 200);

    }

    public function store(Request $request)
{
    // Validación de los datos de entrada
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
    ]);

    // Si la validación falla, retornar los errores
    if ($validator->fails()) {
        return response()->json([
            'message' => 'Error en validación de los datos',
            'errors' => $validator->errors(),
            'status' => 400
        ], 400);
    }


    $especialidad = Especialidad::create([
        'name' => $request->name,
    ]);

    if (!$especialidad) {
        return response()->json([
            'message' => 'Error al crear la especialidad',
            'status' => 500
        ], 500);
    }

    return response()->json([
        'message' => 'Especialidad creado correctamente',
        'especialidad' => $especialidad,
        'status' => 201
    ], 201);
}

    public function show($id)
    {
        $especialidad = Especialidad::find($id);

        if (!$especialidad) {
            $data = [
                'message' => 'No hay especialidades encontradas',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'doctor' => $especialidad,
            'status' => 200
        ];

        return response()->json($data, 200);

    }

    //DELETE//

    public function destroy($id)
    {
        $especialidad = Especialidad::find($id);

        if(!$especialidad) {
            $data = [
                'message' => 'No hay especialides encontradas',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $especialidad->delete();

        $data = [
            'message' => 'especialidad eliminado correctamente',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    //UPDATE//
    public function update(Request $request, $id)
    {
        // Buscar el doctor por ID
        $especialidad = Especialidad::find($id);

        // Verificar si el doctor existe
        if (!$especialidad) {
            return response()->json([
                'message' => 'No se encontró la especialidad',
                'status' => 404
            ], 404);
    }

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        // Si la validación falla, retornar los errores
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Actualizar los datos del doctor
        $especialidad->name = $request->input('name');

        $especialidad->save();

        // Retornar la respuesta exitosa con el doctor actualizado
        return response()->json([
            'message' => 'especialidad actualizada correctamente',
            'doctor' => $especialidad,
            'status' => 200
        ], 200);
    }
}

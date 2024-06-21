<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function index() 
    { 

        $doctores = Doctor::all();

        if ($doctores->isEmpty()) {
            $data = [
                'message' => 'No hay no hay doctores',
                'status' => 200
            ];
            return response()->json($data, 200);
        }

        return response()->json($doctores, 200);

    }

    public function store(Request $request)
{
    // Validación de los datos de entrada
    $validator = Validator::make($request->all(), [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'age' => 'required|integer',
        'especialidad_id' => 'required|exists:especialidades,id',
        'email' => 'required|string|email|max:255|unique:doctores',
        'password' => 'required|string|min:8|max:15',
    ]);

    // Si la validación falla, retornar los errores
    if ($validator->fails()) {
        return response()->json([
            'message' => 'Error en validación de los datos',
            'errors' => $validator->errors(),
            'status' => 400
        ], 400);
    }

    // Crear un nuevo doctor
    $doctor = Doctor::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'age' => $request->age,
        'especialidad_id' => $request->especialidad_id,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // Verificar si se creó correctamente el doctor
    if (!$doctor) {
        return response()->json([
            'message' => 'Error al crear el doctor',
            'status' => 500
        ], 500);
    }

    // Retornar la respuesta exitosa con el doctor creado
    return response()->json([
        'message' => 'Doctor creado correctamente',
        'doctor' => $doctor,
        'status' => 201
    ], 201);
}

    public function show($id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            $data = [
                'message' => 'No hay doctores encontrados',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'doctor' => $doctor,
            'status' => 200
        ];

        return response()->json($data, 200);

    }

    //DELETE//

    public function destroy($id)
    {
        $doctor = Doctor::find($id);

        if(!$doctor) {
            $data = [
                'message' => 'No hay doctores encontrados',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $doctor->delete();

        $data = [
            'message' => 'Doctor eliminado correctamente',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    //UPDATE//
    public function update(Request $request, $id)
    {
        // Buscar el doctor por ID
        $doctor = Doctor::find($id);

        // Verificar si el doctor existe
        if (!$doctor) {
            return response()->json([
                'message' => 'No se encontró el doctor',
                'status' => 404
            ], 404);
    }

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'especialidad_id' => 'required|exists:especialidades,id',
            'email' => 'required|string|email|max:255|unique:doctores,email,' . $doctor->id,
            'password' => 'sometimes|required|string|min:8|max:15', // La contraseña es opcional
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
        $doctor->first_name = $request->input('first_name');
        $doctor->last_name = $request->input('last_name');
        $doctor->age = $request->input('age');
        $doctor->especialidad_id = $request->input('especialidad_id');
        $doctor->email = $request->input('email');

        // Actualizar la contraseña si se proporciona
        if ($request->has('password')) {
            $doctor->password = bcrypt($request->input('password'));
        }

        $doctor->save();

        // Retornar la respuesta exitosa con el doctor actualizado
        return response()->json([
            'message' => 'Doctor actualizado correctamente',
            'doctor' => $doctor,
            'status' => 200
        ], 200);
    }

}


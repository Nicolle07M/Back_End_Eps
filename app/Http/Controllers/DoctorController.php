<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('specialty')->get();
        return response()->json($doctors);
    }

    public function store(Request $request)
    {
        $doctor = Doctor::create($request->all());
        return response()->json($doctor, 201);
    }

    public function show($id)
    {
        $doctor = Doctor::with('specialty')->findOrFail($id);
        return response()->json($doctor);
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->update($request->all());
        return response()->json($doctor);
    }

    public function destroy($id)
    {
        Doctor::destroy($id);
        return response()->json(null, 204);
    }
}


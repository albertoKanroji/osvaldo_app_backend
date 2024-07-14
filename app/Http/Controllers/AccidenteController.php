<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accidente;

class AccidenteController extends Controller
{
    public function index()
    {
        try {
            $accidentes = Accidente::all();
            return response()->json(['data' => $accidentes, 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }

    public function show($id)
    {
        try {
            $accidente = Accidente::findOrFail($id);
            return response()->json(['data' => $accidente, 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $accidente = Accidente::create($request->all());
            return response()->json(['data' => $accidente, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $accidente = Accidente::findOrFail($id);
            $accidente->update($request->all());
            return response()->json(['data' => $accidente, 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Accidente::findOrFail($id)->delete();
            return response()->json(['data' => 'Accidente eliminado', 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }
}

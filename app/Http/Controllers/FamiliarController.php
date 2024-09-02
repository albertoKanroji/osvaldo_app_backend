<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Familiar;

class FamiliarController extends Controller
{
    public function index()
    {
        try {
            $familiares = Familiar::all();
            return response()->json(['data' => $familiares, 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }

    public function show(Request $request)
    {
        try {
            $id = $request->input('id');
            $familiar = Familiar::findOrFail($id);
            return response()->json(['data' => $familiar, 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $familiar = Familiar::create($request->all());
            return response()->json(['data' => $familiar, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $familiar = Familiar::findOrFail($id);
            $familiar->update($request->all());
            return response()->json(['data' => $familiar, 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Familiar::findOrFail($id)->delete();
            return response()->json(['data' => 'Familiar eliminado', 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }
    public function getFamiliaresPorCliente(Request $request)
    {
        try {
            $id = $request->input('id');
            $cliente = Cliente::findOrFail($id);
            $familiares = $cliente->familiares; // Asumiendo que tienes una relación 'familiares' en el modelo Cliente
            return response()->json(['data' => $familiares], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }
}

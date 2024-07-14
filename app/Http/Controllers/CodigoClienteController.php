<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CodigoCliente;

class CodigoClienteController extends Controller
{
    public function index()
    {
        try {
            $codigos = CodigoCliente::all();
            return response()->json(['data' => $codigos, 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }

    public function show($id)
    {
        try {
            $codigo = CodigoCliente::findOrFail($id);
            return response()->json(['data' => $codigo, 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $codigo = CodigoCliente::create($request->all());
            return response()->json(['data' => $codigo, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $codigo = CodigoCliente::findOrFail($id);
            $codigo->update($request->all());
            return response()->json(['data' => $codigo, 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            CodigoCliente::findOrFail($id)->delete();
            return response()->json(['data' => 'Código Cliente eliminado', 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }
}

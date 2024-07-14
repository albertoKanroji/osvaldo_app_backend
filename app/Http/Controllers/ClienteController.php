<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;


class ClienteController extends Controller
{
    public function index()
    {
        try {
            $clientes = Cliente::all();
            return response()->json(['data' => $clientes, 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }

    public function show($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            return response()->json(['data' => $cliente, 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $cliente = Cliente::create($request->all());
            return response()->json(['data' => $cliente, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->update($request->all());
            return response()->json(['data' => $cliente, 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Cliente::findOrFail($id)->delete();
            return response()->json(['data' => 'Cliente eliminado', 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => $e->getMessage(), 'status' => 'error'], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
    public function register(Request $request)
    {
        try {
            // Validar la solicitud
            $request->validate([
                'nombre' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:clientes',
                'password' => 'required|string|min:8|confirmed',
                // 'profile' => 'required'
            ]);

            // Crear el usuario
            $user = Cliente::create([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                // 'profile' => $request->profile,

            ]);

            // Generar el token
            $token = $user->createToken('auth_token')->plainTextToken;

            // Retornar la respuesta con el token
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        } catch (ValidationException $e) {
            // Manejar errores de validación
            return response()->json([
                'error' => 'Validation Error',
                'message' => $e->errors(),
            ], 422);
        } catch (QueryException $e) {
            // Manejar errores de base de datos
            return response()->json([
                'error' => 'Database Error',
                'message' => 'An error occurred while saving the user.',
                'error' => $e
            ], 500);
        } catch (\Exception $e) {
            // Manejar otros errores
            return response()->json([
                'error' => 'Server Error',
                'message' => 'An unexpected error occurred.',
                'error' => $e
            ], 500);
        }
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $cliente = Cliente::where('email', $request->email)->first();

        if (!$cliente || !Hash::check($request->password, $cliente->password)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        $token = $cliente->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'cliente' => $cliente
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }
}

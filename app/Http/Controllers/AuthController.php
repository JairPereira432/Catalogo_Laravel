<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function index()
    {
        // Verifica que el usuario sea admin
        if (auth()->user()->rol !== 'admin') {
            return response()->json(['message' => 'No autorizado'], 403);
        }
 
        // Retorna todos los usuarios
        return User::all();
    }
  public function register(Request $request)
  {
    // Validar los datos de entrada
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:10|confirmed',
    ]);

    // Crear el usuario
    $user = User::create([
      'name' => $validated['name'],
      'email' => $validated['email'],
      'password' => Hash::make($validated['password']),
      'rol' => 'cliente', // Asignar rol por defecto
    ]);

    // Retornar una respuesta exitosa
    return response()->json($user, 201);
  }

  public function login(Request $request)
  {
    // Validar los datos de entrada
    $credentials = $request->validate([
      'email' => 'required|string|email',
      'password' => 'required|string',
    ]);

    // Intentar autenticar al usuario 
    if (!auth()->attempt($credentials)) {
      return response()->json(['message' => 'Credenciales inválidas'], 401);
    }

    // Generar un token de acceso
    $user = Auth::user();
    $token = $user->createToken('auth_token')->plainTextToken;

    // Retornar el token y los datos del usuario
    return response()->json([
      'access_token' => $token,
      'token_type' => 'Bearer',
      'user' => $user
    ]);
  }

  public function logout(Request $request)
  {
    // Eliminar el token de acceso del usuario
    $request->user()->currentAccessToken()->delete();

    // Retornar una respuesta exitosa
    return response()->json(['message' => 'Sesión cerrada correctamente']);
  }
  public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
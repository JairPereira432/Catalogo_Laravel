<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    // Listar todos los productos con sus categorías
    public function index()
    {
        return Producto::with('categorias')->get();
    }

    // Crear un nuevo producto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'categorias' => 'nullable|array', 
            'categorias.*' => 'exists:categorias,id',

        ]);

        $producto = DB::transaction(function() use($validated, $request){
            $producto = Producto::create($validated);
            
            if ($request->has('categorias')) {
                $producto->categorias()->sync($request->categorias);
            }
            
            return $producto;
        });

        return response()->json($producto, 201);
        
    }

    // Mostrar un producto por id
    public function show($id)
    {
        $producto = Producto::with('categorias')->findOrFail($id);
        return response()->json($producto);
    }

    // Actualizar un producto existente
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $validated = $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'descripcion' => 'sometimes|required|string',
            'precio' => 'sometimes|required|numeric',
            'imagen' => 'nullable|string',
            'stock' => 'sometimes|required|integer',
            'categorias' => 'nullable|array',
        ]);

        $producto->update($validated);

        if ($request->has('categorias')) {
            $producto->categorias()->sync($request->categorias);
        }

        return response()->json($producto);
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return response()->json(['message' => 'Producto eliminado']);
    }
}
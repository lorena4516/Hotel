<?php
namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\RoomType;
use App\Models\Accommodation;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all(); // Devuelve todos los hoteles
        return response()->json($hotels);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:hotels|max:255',
            'address' => 'required',
            'city' => 'required',
            'nit' => 'required|unique:hotels',
            'max_rooms' => 'required|integer|min:1',
        ]);

       

        // Crear el hotel
        $hotel = Hotel::create($validated);

        return response()->json($hotel, 201);
    }

    public function show($id)
    {
        return Hotel::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->update($request->all());
        return response()->json($hotel);
    }

    public function destroy($id)
    {
        Hotel::destroy($id);
        return response()->json(null, 204);
    }

    public function assignRoomType(Request $request)
    {
        // Validación de los datos recibidos
        $validatedData = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_type_id' => 'required|exists:room_types,id',
            'accommodation' => 'required|string', 
            'quantity' => 'required|integer|min:1', 
        ]);
        
        try {         
            // Crear la asignación en la tabla 'accommodation_assignments'
            Accommodation::create([
                'hotel_id' => $validatedData['hotel_id'],
                'room_type_id' => $validatedData['room_type_id'],
                'accommodation' => $validatedData['accommodation'], 
                'quantity' => $validatedData['quantity'], // Cantidad
            ]);

            return response()->json(['message' => 'Tipos de habitación asignados correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al asignar tipos de habitación: ' . $e->getMessage()], 500);
        }
    }
}

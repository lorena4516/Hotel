<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    public function getByRoomType($roomTypeId)
    {
        $accommodations = Accommodation::where('room_type_id', $roomTypeId)->get();
        return response()->json($accommodations);
    }
    public function store(Request $request)
    {
        // Validar los datos que vienen del frontend
        $validatedData = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_type_id' => 'required|exists:room_types,id',
            'accommodation' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            // Guardar la asignación de acomodación con la cantidad
            foreach ($validatedData['accommodation'] as $accommodation) {
                Accommodation::create([
                    'hotel_id' => $validatedData['hotel_id'],
                    'room_type_id' => $validatedData['room_type_id'],
                    'accommodation' => $validated['accommodation'], 
                    'quantity' => $validatedData['quantity'],  
                ]);
            }

            return response()->json(['message' => 'Acomodación y cantidad asignadas correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al guardar la asignación: ' . $e->getMessage()], 500);
        }
    }
}

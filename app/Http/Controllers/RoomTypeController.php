<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index()
    {
        return response()->json(RoomType::all());
    }
    public function getByRoomType($id)
    {
        $roomType = RoomType::findOrFail($id);
        $validAccommodations = [];

        // Definir acomodaciones válidas por tipo de habitación
        switch ($roomType->id) {
            case '1':
                $validAccommodations = ['Sencilla', 'Doble'];
                break;
            case '2':
                $validAccommodations = ['Triple', 'Cuádruple'];
                break;
            case '3':
                $validAccommodations = ['Sencilla', 'Doble', 'Triple'];
                break;
            default:
                $validAccommodations = [];
                break;
        }

        return response()->json([
            'roomType' => $roomType,
            'validAccommodations' => $validAccommodations,
        ]);
    }
}

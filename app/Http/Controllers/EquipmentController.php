<?php

namespace App\Http\EquipmentControllers;

use Illuminate\Http\Request;
use App\Models\Equipment;

class EquipmentController extends Controller
{
    public function create()
    {
        return view('equipment.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'short_name' => 'required|max:10',
            'color' => 'required',
            'quantity' => 'required|numeric|min:0',
            'capacity' => 'required|numeric|min:0',
            'description' => 'required',
        ]);

        // Save the equipment to the database
        $equipment = new Equipment;
        $equipment->name = $validatedData['name'];
        $equipment->short_name = $validatedData['short_name'];
        $equipment->color = $validatedData['color'];
        $equipment->quantity = $validatedData['quantity'];
        $equipment->capacity = $validatedData['capacity'];
        $equipment->description = $validatedData['description'];
        $equipment->resource_tracking = $request->input('resource_tracking', false);
        $equipment->save();

        // Redirect to the equipment listing page
        return redirect()->route('equipment.index')
                         ->with('success', 'Equipment created successfully!');
    }

    public function index()
    {
        $equipment = Equipment::all();
        return view('equipment.index', compact('equipment'));
    }
}

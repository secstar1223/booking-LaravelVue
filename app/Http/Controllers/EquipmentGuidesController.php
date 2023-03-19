<?php
namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipmentGuidesController extends Controller
{
    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'short_name' => 'required|max:10',
            'color' => 'required',
            'quantity' => 'required|integer|min:0',
            'capacity' => 'required|integer|min:0',
            'description' => 'required',
        ]);

        $resourceTracking = $request->input('resource_tracking') === 'on';
        
        // Create a new Equipment model with the validated data
        $equipment = new Equipment([
            'name' => $validatedData['name'],
            'short_name' => $validatedData['short_name'],
            'color' => $validatedData['color'],
            'quantity' => $validatedData['quantity'],
            'capacity' => $validatedData['capacity'],
            'description' => $validatedData['description'],
            'resource_tracking' => $resourceTracking,
        ]);

        // Save the Equipment model to the database
        $equipment->save();

        // Redirect the user back to the form
        return back();
    }
    
    public function index()
{
    $equipments = Equipment::all();
    return view('equipmentguides', compact('equipments'));

}

public function show($id)
{
    $equipment = Equipment::find($id);
     dd($equipment); // temporary debugging statement
    return response()->json($equipment);
}




}



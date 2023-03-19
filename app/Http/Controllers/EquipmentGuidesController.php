<?php
namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipmentGuidesController extends Controller
{
    public function store(Request $request)
{
    dd($request); // dump and die the contents of $request

    $data = $request->validate([
        'name' => 'required|max:255',
        'short_name' => 'required|max:10',
        'color' => 'required',
        'quantity' => 'required|integer|min:0',
        'capacity' => 'required|integer|min:0',
        'description' => 'required',
        'resource_tracking' => 'nullable',
        'equip_id' => 'nullable', // Add this validation rule
    ]);

    $resourceTracking = $request->input('resource_tracking') === 'on';
    
    if ($request->has('equip_id')) {
        $equipment = Equipment::findOrFail($request->equip_id);
        $equipment->update([
            'name' => $data['name'],
            'short_name' => $data['short_name'],
            'color' => $data['color'],
            'quantity' => $data['quantity'],
            'capacity' => $data['capacity'],
            'description' => $data['description'],
            'resource_tracking' => $resourceTracking,
        ]);
    } else {
        // Create a new Equipment model with the validated data
        $equipment = new Equipment([
            'name' => $data['name'],
            'short_name' => $data['short_name'],
            'color' => $data['color'],
            'quantity' => $data['quantity'],
            'capacity' => $data['capacity'],
            'description' => $data['description'],
            'resource_tracking' => $resourceTracking,
        ]);

        // Save the Equipment model to the database
        $equipment->save();
    }

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
    if (request()->query('remove')) {
        $equipment = Equipment::find($id);
        if ($equipment) {
            $equipment->delete();
            return response()->json(['message' => 'Equipment deleted successfully']);
        } else {
            return response()->json(['message' => 'Equipment not found'], 404);
        }
    } else {
        $equipment = Equipment::find($id);
        return response()->json($equipment);
    }
}

public function destroy($id)
    {
        $equipment = Equipment::find($id);
        $equipment->delete();
        return response()->json(['message' => 'Equipment deleted successfully']);
    }




}



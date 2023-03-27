<?php
namespace App\Http\Controllers;

use App\Models\EquipmentType;
use App\Models\RentalProduct;
use App\Medels\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class EquipmentTypesController extends Controller
{

    protected function getEquipmentType(RentalProduct $rentalProduct): array {
        $equipmenttypes = [];
        foreach ($rentalProduct->equipmenttypes as $equipmenttype) {
            $equipmenttypes[] = [
                'id' => $equipmenttype->id,
                'name' => $equipmenttype->name,
				'description' => $equipmenttype->description,
				'min-amount' => $equipmenttype->minamount,
				'max-amount' => $equipmenttype->maxamount,
				'require-min' => $equipmenttype->requiremin,
				'widget-image' => $equipmenttype->widgetimage,
				'widget-display' => $equipmenttype->widgetdisplay,
                'errors' => [],
            ];
        }

        return $equipmenttypes;
    }

    public function index(RentalProduct $rentalProduct)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->rentalProducts()->where('id', $rentalProduct->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified equipment type does not exist or is not associated with the current team.']);
        }

        return Inertia::render('EquipmentType/Index', [
            'rentalProductId' => $rentalProduct->id,
            'equipmenttypes' => $this->getEquipmentType($rentalProduct),
			'assets' => $assets,
        ]);
    }

    public function store(RentalProduct $rentalProduct, Request $request)
    {
        $validatedData = $this->validate($request, [
            'name' => 'required|string',
			'asset_id' => 'nullable|exists:assets,id',
            'description' => 'required|numeric',
            'min-amount' => 'nullable|numeric',
            'max-amount' => 'nullable|numeric',
			'require-min' => 'required|boolean',
			'widget-image' => 'nullable|string',
			'widget-display' => 'required|boolean',
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->rentalProducts()->where('id', $rentalProduct->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified equipment type does not exist or is not associated with the current team.']);
        }

        $teamId = auth()->user()->currentTeam->id;
    
        $equipmenttype = new EquipmentType();
        $equipmenttype->name = $validatedData['name'];
		$equipmenttype->description = $validatedData['description'];
		$equipmenttype->minamount = $validatedData['min-amount'];
		$equipmenttype->maxamount = $validatedData['max-amount'];
		$equipmenttype->requiremin = $validatedData['require-min'];
		$equipmenttype->widgetimage = $validatedData['widget-image'];
		$equipmenttype->widgetdisplay = $validatedData['widget-display'];
        $equipmenttype->asset_id = $validatedData['asset_id']; // Set asset_id
        $equipmenttype->save();

        return response()->json(['equipment-types' => $this->getEquipmentType($rentalProduct)]);
    }

    public function update(RentalProduct $rentalProduct, EquipmentType $equipmenttype, Request $request)
    {
        $validatedData = $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|numeric',
			'asset_id' => 'nullable|exists:assets,id',
            'min-amount' => 'nullable|numeric',
            'max-amount' => 'nullable|numeric',
			'require-min' => 'required|boolean',
			'widget-image' => 'nullable|string',
			'widget-display' => 'required|boolean',
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->rentalProducts()->where('id', $rentalProduct->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified equipment type does not exist or is not associated with the current team.']);
        }
		$equipmenttype->name = $validatedData['name'];
		$equipmenttype->description = $validatedData['description'];
		$equipmenttype->minamount = $validatedData['min-amount'];
		$equipmenttype->maxamount = $validatedData['max-amount'];
		$equipmenttype->requiremin = $validatedData['require-min'];
		$equipmenttype->widgetimage = $validatedData['widget-image'];
		$equipmenttype->widgetdisplay = $validatedData['widget-display'];
        $equipmenttype->asset_id = $validatedData['asset_id']; // Set asset_id

        $equipmenttype->save();

        return response()->json(['equipmenttype' => $this->getEquipmentTypes($rentalProduct)]);
    }

    public function destroy(RentalProduct $rentalProduct, EquipmentType $equipmenttype, Request $request)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->rentalProducts()->where('id', $rentalProduct->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified rental product does not exist or is not associated with the current team.']);
        }


        try {
            $equipmenttype->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to delete equipment type.']);
        }

        return response()->json(['equipmenttype' => $this->getEquipmentTypes($rentalProduct)]);
    }
}
<?php
namespace App\Http\Controllers;

use App\Models\EquipmentType;
use App\Models\Detail;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class EquipmentTypesController extends Controller
{

    protected function getEquipmentType(Detail $detail): array {
    $equipmenttypes = [];
        foreach ($detail->equipmenttypes as $equipmenttype) {
            
            $equipmenttypes[] = [
                'id' => $equipmenttype->id,
                'assetID' => $equipmenttype->assetID,
                'rental_product_id' => $equipmenttype->rental_product_id,
                'name' => $equipmenttype->name,
                'description' => $equipmenttype->description,
                'min_amount' => $equipmenttype->min_amount, // Update property name to match column name in database
                'max_amount' => $equipmenttype->max_amount, // Update property name to match column name in database
                'require_min' => $equipmenttype->require_min, // Update property name to match column name in database
                'widget_image' => $equipmenttype->widget_image, // Update property name to match column name in database
                'widget_display' => $equipmenttype->widget_display, // Update property name to match column name in database
                'errors' => [],
            ];
        }
    return $equipmenttypes;
}
    public function index(Detail $detail)
    {
        $user = auth()->user();
        $team = $user->currentTeam;
		$assets = Asset::where('team_id', $user->id)->get();

		$detailQuery = Detail::query()->where('team_id', $team->id);
    	$currentdetail = $detailQuery->find($detail->id);

    if (!$currentdetail) {
        return redirect()->back()->withErrors(['error' => 'The specified asset does not exist or is not associated with the current team.']);
    }
       return Inertia::render('Details/EditNewRentals/equipmenttype', [
			'detail' => $detail,
			'equipmenttypes' => $this->getEquipmentType($detail),
			'assets' => $assets,
		]);
    }

    public function store(Detail $detail, Request $request)
    {
			
        $validatedData = $this->validate($request, [
            'name' => 'required|string',
	        'assetID' => 'required|exists:assets,id',
            'description' => 'required|string',
            'min_amount' => 'nullable|numeric',
            'max_amount' => 'nullable|numeric',
	        'require_min' => 'nullable|boolean',
	        'widget_image' => 'nullable|string',
	        'widget_display' => 'nullable|boolean',
            'rental_product_id' => 'required|numeric',
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;
		
		$detailQuery = Detail::query()->where('team_id', $team->id);
    	$currentdetail = $detailQuery->find($detail->id);

		if (!$currentdetail) {
			return redirect()->back()->withErrors(['error' => 'The specified asset does not exist or is not associated with the current team.']);
		}

        $teamId = auth()->user()->currentTeam->id;

        $equipmenttype = new EquipmentType();
        $equipmenttype->name = $validatedData['name'];
		$equipmenttype->description = $validatedData['description'];
		$equipmenttype->min_amount = $validatedData['min_amount'];
		$equipmenttype->max_amount = $validatedData['max_amount'];
		$equipmenttype->require_min = $validatedData['require_min'];
		$equipmenttype->widget_image = $validatedData['widget_image'];
		$equipmenttype->widget_display = $validatedData['widget_display'];
        $equipmenttype->assetID = $validatedData['assetID']; // Set asset_id
		$equipmenttype->rental_product_id = $validatedData['rental_product_id'];
        $equipmenttype->save();

        $newId = $equipmenttype->id;

        //dd($detail);
       
        return response()->json([
            'equipmenttypes' => $this->getEquipmentType($detail),
            'newId' => $newId,
            /*when it returns it should update the equipment that was just saved, with is_new = false and id = newId */
        
        ]);
    }

    public function update(Detail $detail, EquipmentType $equipmenttypes, Request $request)
    {
        
        $validatedData = $this->validate($request, [
            'id' => 'required',
            'name' => 'required|string',
	        'assetID' => 'required|exists:assets,id',
            'description' => 'required|string',
            'min_amount' => 'nullable|numeric',
            'max_amount' => 'nullable|numeric',
	        'require_min' => 'nullable|boolean',
	        'widget_image' => 'nullable|string',
	        'widget_display' => 'nullable|boolean',
            'rental_product_id' => 'required|numeric',
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;

        $detailQuery = Detail::query()->where('team_id', $team->id);
    	$currentdetail = $detailQuery->find($detail->id);

        if (!$currentdetail) {
			return redirect()->back()->withErrors(['error' => 'The specified asset does not exist or is not associated with the current team.']);
		}

        $equipmenttypes = EquipmentType::find($validatedData['id']);

        $equipmenttypes->name = $validatedData['name'];
		$equipmenttypes->description = $validatedData['description'];
		$equipmenttypes->min_amount = $validatedData['min_amount'];
		$equipmenttypes->max_amount = $validatedData['max_amount'];
		$equipmenttypes->require_min = $validatedData['require_min'];
		$equipmenttypes->widget_image = $validatedData['widget_image'];
		$equipmenttypes->widget_display = $validatedData['widget_display'];
        $equipmenttypes->assetID = $validatedData['assetID']; // Set asset_id
		$equipmenttypes->rental_product_id = $validatedData['rental_product_id'];

        $equipmenttypes->save();

        return response()->json(['equipmenttypes' => $this->getEquipmentType($detail)]);
    }

    public function destroy(Detail $detail, EquipmentType $equipmenttypes, Request $request)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        //if (!$team->Detail()->where('id', $detail->id)->exists()) {
        //    return redirect()->back()->withErrors(['error' => 'The specified rental product does not exist or is not associated with the current team.']);
       // }
       $validatedData = $this->validate($request, [
        'id' => 'required',
        'name' => 'required|string',
        'assetID' => 'required|exists:assets,id',
        'description' => 'required|string',
        'min_amount' => 'nullable|numeric',
        'max_amount' => 'nullable|numeric',
        'require_min' => 'nullable|boolean',
        'widget_image' => 'nullable|string',
        'widget_display' => 'nullable|boolean',
        'rental_product_id' => 'required|numeric',
    ]);

        try {
            $equipmenttypes = EquipmentType::find($validatedData['id']);
            $equipmenttypes->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to delete equipment type.']);
        }

        return response()->json(['equipmenttypes' => $this->getEquipmentType($detail)]);
    }
}
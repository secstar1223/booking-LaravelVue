<?php
namespace App\Http\Controllers;

use App\Models\EquipmentType;
use App\Models\Details;
use App\Models\Durations;
use App\Medels\Prices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PriceController extends Controller
{

    protected function getPrice(Details $details): array {
        $details = [];
        foreach ($details->prices as $price) {
            $price[] = [
                'id' => $price->id,
                'total' => $price->total,
				'deposit' => $price->deposit,
                'errors' => [],
            ];
        }

        return $prices;
    }

    public function index(Details $details)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->details()->where('id', $details->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified equipment type does not exist or is not associated with the current team.']);
        }

        return Inertia::render('EquipmentType/Index', [
            'detailsId' => $details->id,
            'equipment-type-id' => $this->getEquipmentType($details),
			'Duration-name' => $this->getDurations($durations),
        ]);
    }

    public function store(Details $details, Request $request)
    {
        $validatedData = $this->validate($request, [
            'total' => 'required|string',
			'equipment_type_id' => 'nullable|exists:assets,id',
            'deposit' => 'required|numeric',
            'duration_name' => 'nullable|exists:duration,name',
            'product_id' => 'nullable|exists:details,id',
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->details()->where('id', $details->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified equipment type does not exist or is not associated with the current team.']);
        }

        $teamId = auth()->user()->currentTeam->id;
    
        $prices = new Prices();
        $prices->total = $validatedData['total'];
		$prices->deposit = $validatedData['deposit'];
		$prices->equipmenttypeid = $validatedData['equipment_type_id'];
		$prices->durationname = $validatedData['duration_name'];
        $prices->detailID = $validatedData['detailID']; 
        $prices->save();

        return response()->json(['prices' => $this->getPrices($details)]);
    }

    public function update(details $details, Prices $prices, Request $request)
    {
        $validatedData = $this->validate($request, [
           'total' => 'required|string',
			'equipment_type_id' => 'nullable|exists:assets,id',
            'deposit' => 'required|numeric',
            'duration_name' => 'nullable|exists:duration,name',
            'product_id' => 'nullable|exists:details,id',
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->details()->where('id', $details->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified equipment type does not exist or is not associated with the current team.']);
        }
		$prices->total = $validatedData['total'];
		$prices->deposit = $validatedData['deposit'];
		$prices->equipmenttypeid = $validatedData['equipment_type_id'];
		$prices->durationname = $validatedData['duration_name'];
        $prices->detailID = $validatedData['detailID']; 

        $prices->save();

        return response()->json(['prices' => $this->getPrices($details)]);
    }

    
}

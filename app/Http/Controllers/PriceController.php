<?php
namespace App\Http\Controllers;

use App\Models\EquipmentType;
use App\Models\Detail;
use App\Models\Duration;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PriceController extends Controller
{

   protected function getPrices(Detail $detail): array {
    $prices = [];
    foreach ($detail->durations as $duration) {
        foreach ($duration->price as $price) {
            $prices[] = [
                'id' => $price->id,
                'total' => $price->total,
                'deposit' => $price->deposit,
				'duration_id' => $price->duration_id,
				'equipment_id' => $price->equipment_id,
				'rental_product_id' => $price->rental_product_id,
                'errors' => [],
            ];
        }
    }
    return $prices;
}


    public function index(Detail $detail)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

		$detailQuery = Detail::query()->where('team_id', $team->id);
    	$currentDetail = Detail::with('durations.price','equipmenttypes')->where('team_id', $team->id)->find($detail->id);

    if (!$currentDetail) {
        return redirect()->back()->withErrors(['error' => 'The specified asset does not exist or is not associated with the current team.']);
    }

    //dd($currentDetail);
    $detail = $currentDetail;


    return Inertia::render('Details/EditNewRentals/price', [
        'price'  => $this->getPrices($detail),
        'detail' => $detail,
        'durations' => $detail->durations,
        'equipmenttype' => $detail->equipmenttypes,
        
        ]);
    }

    public function store(Detail $detail, Request $request)
    {
        $validatedData = $this->validate($request, [
            'total' => 'required|numeric',
			'equipment_id' => 'nullable|exists:rental_equipment_types,id',
            'deposit' => 'required|numeric',
            'duration_id' => 'nullable|exists:durations,id',
            'rental_product_id' => 'nullable|exists:rental_product,id',
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;

      //  if (!$team->details()->where('id', $details->id)->exists()) {
      //      return redirect()->back()->withErrors(['error' => 'The specified equipment type does not exist or is not associated with the current team.']);
      //  }

        $teamId = auth()->user()->currentTeam->id;
    
        $prices = new Price();
        $prices->total = $validatedData['total'];
		$prices->deposit = $validatedData['deposit'];
		$prices->equipment_id = $validatedData['equipment_id'];
		$prices->duration_id = $validatedData['duration_id'];
        $prices->rental_product_id = $validatedData['rental_product_id']; 
        $prices->save();

        return response()->json(['price' => $this->getPrices($detail)]);
    }

    public function update(detail $detail, Price $price, Request $request)
    {
		//dd($request);
        $validatedData = $this->validate($request, [
           'total' => 'required|numeric',
			'equipment_id' => 'nullable|exists:rental_equipment_types,id',
            'deposit' => 'required|numeric',
            'duration_id' => 'nullable|exists:durations,id',
            'rental_product_id' => 'nullable|exists:rental_product,id',
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;

       // if (!$team->details()->where('id', $details->id)->exists()) {
       //     return redirect()->back()->withErrors(['error' => 'The specified equipment type does not exist or is not associated with the current team.']);
       // }
		$price->total = $validatedData['total'];
		$price->deposit = $validatedData['deposit'];
		$price->equipment_id = $validatedData['equipment_id'];
		$price->duration_id = $validatedData['duration_id'];
        $price->rental_product_id = $validatedData['rental_product_id']; 

        $price->save();

        return response()->json(['price' => $this->getPrices($detail)]);
    }

  
}

<?php
namespace App\Http\Controllers;

use App\Models\Duration;
use App\Models\Detail;
use App\Http\Controllers\Details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DurationsController extends Controller
{
    protected function timestampToParts(int $duration): array {
        $days = floor($duration/86400);
        $hours = floor(($duration-($days*86400))/3600);
        $minutes = floor(($duration-($days*86400)-($hours*3600))/60);
        return [
            'days' => $days,
            'hours' => $hours,
            'minutes' => $minutes,
        ];
    }

    protected function partsToTimestamp(array $parts): int {
        return $parts['days'] * 86400 + $parts['hours'] * 3600 + $parts['minutes'] * 60;
    }

    protected function getDurations(Detail $detail): array {
        $durations = [];
       // dd($detail);
        foreach ($detail->durations as $duration) {
            $parts = $this->timestampToParts($duration->duration);
            $durations[] = [
                'id' => $duration->id,
                'name' => $duration->name,
                'days' => $parts['days'],
                'hours' => $parts['hours'],
                'minutes' => $parts['minutes'],
                'has_changes' => true,
                'rental_product_id' =>$duration->rental_product_id,
                'errors' => [],
            ];
        }

        return $durations;
    }

    public function index(Detail $detail)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

		$durationQuery = Detail::query()->where('team_id', $team->id);
    	$currentdurations = $durationQuery->find($detail->id);

        if (!$currentdurations) {
            return redirect()->back()->withErrors(['error' => 'The specified asset does not exist or is not associated with the current team.']);
        }

        return Inertia::render('Details/EditNewRentals/durations', [
            'detail' => $detail,
            'durations' => $this->getDurations($detail),
        ]);
    }

    public function store(Detail $detail, Request $request)
    {
        $validatedData = $this->validate($request, [
            'name' => 'required|string',
            'days' => 'required|numeric',
            'hours' => 'required|numeric',
            'minutes' => 'required|numeric',
            'rental_product_id' => 'required|numeric'
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;

       
        $detailQuery = Detail::query()->where('team_id', $team->id);
    	$currentdetail = $detailQuery->find($detail->id);

       // if (!$currentdetail) {
		//	return redirect()->back()->withErrors(['error' => 'The specified asset does not exist or is not associated with the current team.']);
		//}

        $teamId = auth()->user()->currentTeam->id;
    
        $duration = new Duration();
        $duration->name = $validatedData['name'];
        $duration->duration = $this->partsToTimestamp($validatedData);
        $duration->rental_product_id = $validatedData['rental_product_id'];
        $duration->buffer = 0;  //need to add buffer option
        $duration->save();

        return response()->json([
            'detail' => $detail,
            'durations' => $this->getDurations($detail)]);
    }

    public function update(Detail $detail, Duration $duration, Request $request)
    {
        $validatedData = $this->validate($request, [
            'id' => 'required',
            'name' => 'required|string',
            'days' => 'required|numeric',
            'hours' => 'required|numeric',
            'minutes' => 'required|numeric',
            'rental_product_id' => 'required|numeric'
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;

      //  if (!$team->details()->where('id', $details->id)->exists()) {
      //      return redirect()->back()->withErrors(['error' => 'The specified rental product does not exist or is not associated with the current team.']);
      //  }

      //  if (!$details->durations()->where('id', $duration->id)->exists()) {
      //      return redirect()->back()->withErrors(['error' => 'The specified duration does not exist or is not associated with the current team.']);
      //  }

        $duration = Duration::find($validatedData['id']);

        $duration->name = $validatedData['name'];
        $duration->duration = $this->partsToTimestamp($validatedData);
        $duration->rental_product_id = $validatedData['rental_product_id'];
        $duration->buffer = 0;  //need to add buffer option
        $duration->save();

        return response()->json([
            'detail' => $detail,
            'durations' => $this->getDurations($detail)]);
    }
    

    public function destroy(Detail $detail, Duration $duration, Request $request)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        $validatedData = $this->validate($request, [
            'id' => 'required',
            'name' => 'required|string',
            'days' => 'required|numeric',
            'hours' => 'required|numeric',
            'minutes' => 'required|numeric',
            'rental_product_id' => 'required|numeric'
        ]);

      //  if (!$team->details()->where('id', $details->id)->exists()) {
      //      return redirect()->back()->withErrors(['error' => 'The specified rental product does not exist or is not associated with the current team.']);
      //  }

      //  if (!$details->durations()->where('id', $duration->id)->exists()) {
       //     return redirect()->back()->withErrors(['error' => 'The specified duration does not exist or is not associated with the current team.']);
      //  }

        try {
            $duration = Duration::find($validatedData['id']);
            $duration->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to delete duration.']);
        }

        return response()->json(['durations' => $this->getDurations($detail)]);
    }

    public function prices(Request $request)
{   
    $total = $request->input('total');
    $deposit = $request->input('deposit');
    $equipmentTypeId = $detail->equipmenttypes.id;
    $durationId = $detail->durations.id;


    $price = new Price;
    $price->total = $total;
    $price->deposit = $deposit;
    $price->save();

    

    $duration = Duration::find($durationId); // Assuming you have the Duration model

    $equipmentType = EquipmentType::find($equipmentTypeId); // Assuming you have the EquipmentType model

    $duration->prices()->attach($price, ['equipment_type_id' => $equipmentType->id]); // Assuming you have defined the prices() relationship with the appropriate pivot table and columns in the Duration model

    // Redirect to the appropriate route or page
    return redirect('Details/EditNewRentals/price');
}

    
}

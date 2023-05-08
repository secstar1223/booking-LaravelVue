<?php
namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\EquipmentType;
use App\Models\Price;
use App\Models\Duration;
use App\Models\Availability;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DetailsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $team = $user->currentTeam;
        $details = $team->details;
    
        $equipmenttypes = [];
        $prices = [];
        $durations = [];
        $availabilities = [];

foreach ($details as $detail) {
    $equipmenttypes[] = $detail->equipmenttypes ?? [];
    $prices[] = $detail->prices ?? [];
    $durations[] = $detail->durations ?? [];
    $availabilities[] = $detail->availabilities ?? [];
    }

return Inertia::render('Details/Index', [
    'details' => $details,
    'equipmenttypes' => $equipmenttypes,
    'prices' => $prices,
    'durations' => $durations,
    'availabilities' => $availabilities,
]);
    }

    

 public function editnewrentals( Detail $detail)
    {
        $user = auth()->user();
        $team = $user->currentTeam;
        $details = $team->details;

        return Inertia::render('Details/EditNewRentals', [
            'detail' => $detail,
        ]);
    }


    public function create()
    {
        return Inertia::render('Details/Create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
        ]);

        $teamId = auth()->user()->currentTeam->id;
    
        $detail = new Detail();
        $detail->name = $validatedData['name'];
        $detail->description = $validatedData['description'];
        $detail->image = $validatedData['image'];
        $detail->team_id = $teamId;
        $detail->save();

       return redirect()->route('details.editnewrentals', ['detail' => $detail->id]);
    }

    public function edit(Detail $detail)
    {
        return Inertia::render('Details/Edit', [
            'detail' => $detail,
        ]);
    }

    public function update(Request $request, Detail $detail)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->details()->where('id', $detail->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified details does not exist or is not associated with the current team.']);
        }

        $detail->name = $validatedData['name'];
        $detail->description = $validatedData['description'];
        $detail->image = $validatedData['image'];
        $detail->save();

        return redirect()->route('details.index');
    }

    public function destroy(Detail $detail)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->details()->where('id', $detail->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified detail does not exist or is not associated with the current team.']);
        }

        try {
            $detail->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to delete detail.']);
        }

        return redirect()->route('details.index');
    }


    public function equipmenttypes(Request $request)
    {

        
        $name = $request->input('name');
        $assetID = $request->input('assetID');
        $detailID = $request->input('detailID');
        $description = $request->input('description');
        $widgetImage = $request->input('widgetImage');
        $widgetDisplay = $request->input('widgetDisplay');
        $minValue = $request('minAmount');
        $maxValue = $request->input('maxAmount');
        $requireMin = $request->input('requireMin');

        $EquipmentType = new EquipmentType;
        $EquipmentType->name = $name;
        $EquipmentType->assetID = $assetID;
        $EquipmentType->detailID = $detailID;
        $EquipmentType->description = $description;
        $EquipmentType->widgetimage = $widgetImage;
        $EquipmentType->widgetdisplay = $widgetDisplay;
        $EquipmentType->minamount = $minValue;
        $EquipmentType->maxamount = $maxValue;
        $EquipmentType->requiremin = $requireMin;

        $EquipmentType->save();

        $detail['equipmenttype'] = $EquipmentType;
    

        return redirect('Details/EditNewRentals/equipmenttype');

    }
	
	    public function durations(Request $request)
    {   
        $name = $request->input('name');
        $days = $request->input('days');
        $hours = $request->input('hours');
        $minutes = $request->input('minutes');


        $Duration = new Duration;
        $Duration->name = $name;
        $Duration->product_rental_id= $detailID;
        $Duration->days = $days;
        $Duration->hours = $hours;
        $Duration->minutes = $minutes;

      

        $Duration->save();

        $detail['duration'] = $Duration;
    

        return redirect('Details/EditNewRentals/durations');

    }

    public function availabilities(Request $request)
    {   
        $availability_type = $request->input('availability_type');
        $first_time = $request->input('first_time');
        $last_time = $request->input('last_time');
        $applies_to = $request->input('applies_to');


        $Availability = new Availability;
        $Availability->availability_type = $availability_type;
        $Availability->product_rental_id= $detailID;
        $Availability->first_time = $first_time;
        $Availability->last_time = $last_time;
        $Availability->applies_to = $applies_to;

      

        $Availability->save();

        $detail['availabilities'] = $Availability;
    

        return redirect('Details/EditNewRentals/availabilityindex');

    }
}

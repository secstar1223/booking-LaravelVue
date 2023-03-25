<?php
namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\RentalProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AvailabilityController extends Controller
{
    public function index(RentalProduct $rentalProduct)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->rentalProducts()->where('id', $rentalProduct->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified rental product does not exist or is not associated with the current team.']);
        }

        $availabilities = [];
        foreach ($rentalProduct->availabilities as $available) {
            $appliesTo = [];
            foreach ($available->durations as $duration) {
                $appliesTo[] = [$duration->name, $duration->id];
            }
            $availabilities[] = [
                'id' => $available->id,
                'availability_type' => $available->availability_type,
                'first_time' => $available->first_time,
                'last_time' => $available->last_time,
                'applies_to' => $appliesTo,
                /*'starts_every',
                'starts_specific',
                'created_timezone',
                'display_created_timezone',*/
            ];
        }

        return Inertia::render('Availability/Index', [
            'availabilities' => $availabilities,
        ]);
    }

    public function create()
    {
        return Inertia::render('Availability/Create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'type' => 'required|string|in:fixed,percent',
        ]);

        $teamId = auth()->user()->currentTeam->id;
    
        $availability = new Availability();
        $availability->name = $validatedData['name'];
        $availability->amount = $validatedData['amount'];
        $availability->type = $validatedData['type'];
        $availability->team_id = $teamId;
        $availability->save();

        return redirect()->route('tax-rules.index');
    }

    public function edit(Availability $availability)
    {
        return Inertia::render('Availability/Edit', [
            'availability' => $availability,
        ]);
    }

    public function update(Request $request, Availability $availability)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'type' => 'required|string|in:fixed,percent',
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->availability()->where('id', $availability->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified tax rule does not exist or is not associated with the current team.']);
        }

        $availability->name = $validatedData['name'];
        $availability->amount = $validatedData['amount'];
        $availability->type = $validatedData['type'];
        $availability->save();

        return redirect()->route('tax-rules.index');
    }

    public function destroy(Availability $availability)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->availability()->where('id', $availability->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified tax rule does not exist or is not associated with the current team.']);
        }

        try {
            $availability->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to delete tax rule.']);
        }

        return redirect()->route('tax-rules.index');
    }
}

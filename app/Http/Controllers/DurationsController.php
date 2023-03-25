<?php
namespace App\Http\Controllers;

use App\Models\Duration;
use App\Models\RentalProduct;
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

    protected function getDurations(RentalProduct $rentalProduct): array {
        $durations = [];
        foreach ($rentalProduct->durations as $duration) {
            $parts = $this->timestampToParts($duration->duration);
            $durations[] = [
                'id' => $duration->id,
                'name' => $duration->name,
                'days' => $parts['days'],
                'hours' => $parts['hours'],
                'minutes' => $parts['minutes'],
                'has_changes' => false,
                'errors' => [],
            ];
        }

        return $durations;
    }

    public function index(RentalProduct $rentalProduct)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->rentalProducts()->where('id', $rentalProduct->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified rental product does not exist or is not associated with the current team.']);
        }

        return Inertia::render('Durations/Index', [
            'rentalProductId' => $rentalProduct->id,
            'durations' => $this->getDurations($rentalProduct),
        ]);
    }

    public function store(RentalProduct $rentalProduct, Request $request)
    {
        $validatedData = $this->validate($request, [
            'name' => 'required|string',
            'days' => 'required|numeric',
            'hours' => 'required|numeric',
            'minutes' => 'required|numeric',
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->rentalProducts()->where('id', $rentalProduct->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified rental product does not exist or is not associated with the current team.']);
        }

        $teamId = auth()->user()->currentTeam->id;
    
        $duration = new Duration();
        $duration->name = $validatedData['name'];
        $duration->duration = $this->partsToTimestamp($validatedData);
        $duration->rental_product_id = $rentalProduct->id;
        $duration->save();

        return response()->json(['durations' => $this->getDurations($rentalProduct)]);
    }

    public function update(RentalProduct $rentalProduct, Duration $duration, Request $request)
    {
        $validatedData = $this->validate($request, [
            'name' => 'required|string',
            'days' => 'required|numeric',
            'hours' => 'required|numeric',
            'minutes' => 'required|numeric',
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->rentalProducts()->where('id', $rentalProduct->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified rental product does not exist or is not associated with the current team.']);
        }

        if (!$rentalProduct->durations()->where('id', $duration->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified duration does not exist or is not associated with the current team.']);
        }

        $duration->name = $validatedData['name'];
        $duration->duration = $this->partsToTimestamp($validatedData);
        $duration->save();

        return response()->json(['durations' => $this->getDurations($rentalProduct)]);
    }

    public function destroy(RentalProduct $rentalProduct, Duration $duration, Request $request)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->rentalProducts()->where('id', $rentalProduct->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified rental product does not exist or is not associated with the current team.']);
        }

        if (!$rentalProduct->durations()->where('id', $duration->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified duration does not exist or is not associated with the current team.']);
        }

        try {
            $duration->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to delete duration.']);
        }

        return response()->json(['durations' => $this->getDurations($rentalProduct)]);
    }
}

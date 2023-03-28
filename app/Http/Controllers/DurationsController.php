<?php
namespace App\Http\Controllers;

use App\Models\Duration;
use App\Models\Detail;
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

    protected function getDurations(Details $Details): array {
        $durations = [];
        foreach ($details->durations as $duration) {
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

    public function index(details $details)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->details()->where('id', $details->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified rental product does not exist or is not associated with the current team.']);
        }

        return Inertia::render('Durations/Index', [
            'details' => $details->id,
            'durations' => $this->getDurations($details),
        ]);
    }

    public function store(details $details, Request $request)
    {
        $validatedData = $this->validate($request, [
            'name' => 'required|string',
            'days' => 'required|numeric',
            'hours' => 'required|numeric',
            'minutes' => 'required|numeric',
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->details()->where('id', $details->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified rental product does not exist or is not associated with the current team.']);
        }

        $teamId = auth()->user()->currentTeam->id;
    
        $duration = new Duration();
        $duration->name = $validatedData['name'];
        $duration->duration = $this->partsToTimestamp($validatedData);
        $duration->detailID = $details->id;
        $duration->save();

        return response()->json(['durations' => $this->getDurations($details)]);
    }

    public function update(Details $details, Duration $duration, Request $request)
    {
        $validatedData = $this->validate($request, [
            'name' => 'required|string',
            'days' => 'required|numeric',
            'hours' => 'required|numeric',
            'minutes' => 'required|numeric',
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->details()->where('id', $details->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified rental product does not exist or is not associated with the current team.']);
        }

        if (!$details->durations()->where('id', $duration->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified duration does not exist or is not associated with the current team.']);
        }

        $duration->name = $validatedData['name'];
        $duration->duration = $this->partsToTimestamp($validatedData);
        $duration->save();

        return response()->json(['durations' => $this->getDurations($details)]);
    }

    public function destroy(Details $details, Duration $duration, Request $request)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->details()->where('id', $details->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified rental product does not exist or is not associated with the current team.']);
        }

        if (!$details->durations()->where('id', $duration->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified duration does not exist or is not associated with the current team.']);
        }

        try {
            $duration->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to delete duration.']);
        }

        return response()->json(['durations' => $this->getDurations($details)]);
    }
}

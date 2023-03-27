<?php
namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\Details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AvailabilityController extends Controller
{
    public function index(Details $details)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        if ($details->team->id !== $team->id) {
            return redirect()->back()->withErrors(['error' => 'The specified rental product does not exist or is not associated with the current team.']);
        }

        $availabilities = [];
        foreach ($dtails->availabilities as $available) {
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
            'detailsId' => $details->id,
            'availabilities' => $availabilities,
        ]);
    }

    public function create(Details $details)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        if ($details->team->id !== $team->id) {
            return redirect()->back()->withErrors(['error' => 'The specified rental product does not exist or is not associated with the current team.']);
        }

        $durations = [];
        foreach ($details->durations as $duration) {
            $durations[] = [
                'id' => $duration->id,
                'name' => $duration->name,
            ];
        }

        return Inertia::render('Availability/Create', [
            'detailsId' => $details->id,
            'durations' => $durations,
        ]);
    }

    public function store(details $details, Request $request)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        if ($details->team->id !== $team->id) {
            return response()->json(['errors' => [
                'days' => 'The specified rental product does not exist or is not associated with the current team.',
            ]]);
        }

        $validatedData = $request->validate([
            'mon' => 'required|bool',
            'tue' => 'required|bool',
            'wed' => 'required|bool',
            'thu' => 'required|bool',
            'fri' => 'required|bool',
            'sat' => 'required|bool',
            'sun' => 'required|bool',
            'times' => 'required|string|in:repeats,specific',
            'starts_every' => 'required|numeric',
            'start_time' => 'required|numeric',
            'end_time' => 'required|numeric',
            'starts_specific' => 'array',
            'durations' => 'required|array',
        ]);

        $invalid_time = false;
        $validatedData['starts_specific'] = array_map(function($time) use ($invalid_time) {
            if ($time > 86400) {
                $time -= 86400;
                if ($time > 86400) {
                    $invalid_time = true;
                }
            }

            return $time;
        }, $validatedData['starts_specific']);

        sort($validatedData['starts_specific']);

        $availability = new Availability();
        $availability->mon = $validatedData['mon'];
        $availability->tue = $validatedData['tue'];
        $availability->wed = $validatedData['wed'];
        $availability->thu = $validatedData['thu'];
        $availability->fri = $validatedData['fri'];
        $availability->sat = $validatedData['sat'];
        $availability->sun = $validatedData['sun'];
        $availability->times = $validatedData['times'];
        $availability->starts_every = ($validatedData['times'] == 'specific' ? 0 : $validatedData['starts_every']);
        $availability->start_time = ($validatedData['times'] == 'specific' ? $validatedData['starts_specific'][0] : $validatedData['start_time']);//$validatedData['start_time'];
        $availability->end_time = ($validatedData['times'] == 'specific' ? $validatedData['starts_specific'][count($validatedData['starts_specific'])-1] : $validatedData['end_time']);//$validatedData['end_time'];
        $availability->starts_specific = $validatedData['starts_specific'];
        $availability->details()->associate($details);
        $availability->save();

        $durations = $details->durations()->whereIn('id', $validatedData['durations'])->get();
        foreach ($durations as $duration) {
            $availability->durations()->attach($duration);
        }

        return response()->json(['success' => true]);
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

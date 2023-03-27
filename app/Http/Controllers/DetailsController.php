<?php
namespace App\Http\Controllers;

use App\Models\Detail;
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

        return Inertia::render('Details/Index', [
            'details' => $details,
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

        return redirect()->route('details.index');
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
}

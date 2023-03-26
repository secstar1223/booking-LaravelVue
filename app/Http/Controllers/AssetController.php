<?php
namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AssetController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $team = $user->currentTeam;
        $asset = $team->asset;

        return Inertia::render('Asset/Index', [
            'asset' => $asset,
        ]);
    }

    public function create()
    {
        return Inertia::render('Asset/Create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'resource_tracking' => 'required|boolean',
        ]);

        $teamId = auth()->user()->currentTeam->id;
    
        $asset = new TaxRule();
        $asset->name = $validatedData['name'];
        $asset->amount = $validatedData['amount'];
        $asset->type = $validatedData['resource_tracking'];
        $asset->team_id = $teamId;
        $asset->save();

        return redirect()->route('asset.index');
    }

    public function edit(Asset $asset)
    {
        return Inertia::render('Asset/Edit', [
            'asset' => $asset,
        ]);
    }

    public function update(Request $request, Asset $asset)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'resource_tracking' => 'required|boolean',
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->asset()->where('id', $asset->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified asset does not exist or is not associated with the current team.']);
        }

        $asset->name = $validatedData['name'];
        $asset->amount = $validatedData['amount'];
        $asset->resource_tracking = $validatedData['resource_tracking'];
        $asset->save();

        return redirect()->route('asset.index');
    }

    public function destroy(Asset $asset)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->asset()->where('id', $asset->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified asset does not exist or is not associated with the current team.']);
        }

        try {
            $asset->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to delete asset.']);
        }

        return redirect()->route('asset.index');
    }
}

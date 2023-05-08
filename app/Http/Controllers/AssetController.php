<?php
namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AssetController extends Controller
{
    public function index()
    {
       $user = auth()->user();
       $team = $user->currentTeam;
       $assetsQuery = Asset::query()->where('team_id', $team->id);
       $assets = $assetsQuery->get();

        return Inertia::render('Asset/Index', [
        'assets' => $assets,
        'team' => $team,
        'user' => $user,
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
    
        $asset = new Asset();
        $asset->name = $validatedData['name'];
        $asset->amount = $validatedData['amount'];
        $asset->resource_tracking = $validatedData['resource_tracking'];
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

        $assetsQuery = Asset::query()->where('team_id', $team->id);
    	$currentAsset = $assetsQuery->find($asset->id);

    if (!$currentAsset) {
        return redirect()->back()->withErrors(['error' => 'The specified asset does not exist or is not associated with the current team.']);
    }

    $currentAsset->name = $validatedData['name'];
    $currentAsset->amount = $validatedData['amount'];
    $currentAsset->resource_tracking = $validatedData['resource_tracking'];
    $currentAsset->save();
        return redirect()->route('asset.index');
    }

    public function destroy(Asset $asset)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        $assetsQuery = Asset::query()->where('team_id', $team->id);
    	$currentAsset = $assetsQuery->find($asset->id);

    if (!$currentAsset) {
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

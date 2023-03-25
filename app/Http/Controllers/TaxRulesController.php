<?php
namespace App\Http\Controllers;

use App\Models\TaxRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TaxRulesController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $team = $user->currentTeam;
        $taxRules = $team->taxRules;

        return Inertia::render('TaxRules/Index', [
            'taxRules' => $taxRules,
        ]);
    }

    public function create()
    {
        return Inertia::render('TaxRules/Create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'type' => 'required|string|in:fixed,percent',
        ]);

        $teamId = auth()->user()->currentTeam->id;
    
        $taxRule = new TaxRule();
        $taxRule->name = $validatedData['name'];
        $taxRule->amount = $validatedData['amount'];
        $taxRule->type = $validatedData['type'];
        $taxRule->team_id = $teamId;
        $taxRule->save();

        return redirect()->route('tax-rules.index');
    }

    public function edit(TaxRule $taxRule)
    {
        return Inertia::render('TaxRules/Edit', [
            'taxRule' => $taxRule,
        ]);
    }

    public function update(Request $request, TaxRule $taxRule)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'type' => 'required|string|in:fixed,percent',
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->taxRules()->where('id', $taxRule->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified tax rule does not exist or is not associated with the current team.']);
        }

        $taxRule->name = $validatedData['name'];
        $taxRule->amount = $validatedData['amount'];
        $taxRule->type = $validatedData['type'];
        $taxRule->save();

        return redirect()->route('tax-rules.index');
    }

    public function destroy(TaxRule $taxRule)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->taxRules()->where('id', $taxRule->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified tax rule does not exist or is not associated with the current team.']);
        }

        try {
            $taxRule->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to delete tax rule.']);
        }

        return redirect()->route('tax-rules.index');
    }
}

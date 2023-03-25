<?php
namespace App\Http\Controllers;

use App\Models\TaxGroup;
use App\Models\TaxRules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TaxGroupsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $team = $user->currentTeam;
        $taxGroups = $team->taxGroups;

        return Inertia::render('TaxGroups/Index', [
            'taxGroups' => $taxGroups,
        ]);
    }

    public function create()
    {
        $user = auth()->user();
        $team = $user->currentTeam;
        $taxRules = [];

        foreach ($team->taxRules as $rule) {
            $taxRules[$rule->id] = $rule->name;
        }

        return Inertia::render('TaxGroups/Create', [
            'taxRules' => $taxRules,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'rules' => 'array',
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;

        $taxGroup = new TaxGroup();
        $taxGroup->name = $validatedData['name'];
        $taxGroup->team_id = $team->id;
        $taxGroup->save();

        array_unique($validatedData['rules']);
        foreach ($validatedData['rules'] as $ruleId) {
            if (!$team->taxRules()->where('id', $ruleId)->exists()) {
                return redirect()->back()->withErrors(['error' => 'The specified tax rule does not exist or is not associated with the current team.']);
            }

            $taxGroup->rules()->attach($ruleId);
        }

        return redirect()->route('tax-groups.index');
    }

    public function edit(TaxGroup $taxGroup)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->taxGroups()->where('id', $taxGroup->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified tax group does not exist or is not associated with the current team.']);
        }

        $taxRules = [];

        foreach ($team->taxRules as $rule) {
            $taxRules[$rule->id] = $rule->name;
        }

        $rules = [];
        foreach ($taxGroup->rules as $rule) {
            $rules[] = $rule->id;
        }

        return Inertia::render('TaxGroups/Edit', [
            'groupId' => $taxGroup->id,
            'groupName' => $taxGroup->name,
            'groupRules' => $rules,
            'taxRules' => $taxRules,
        ]);
    }

    public function update(Request $request, TaxGroup $taxGroup)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'rules' => 'array',
        ]);

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team->taxGroups()->where('id', $taxGroup->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'The specified tax group does not exist or is not associated with the current team.']);
        }

        $taxGroup->name = $validatedData['name'];
        $taxGroup->save();

        array_unique($validatedData['rules']);
        $ruleIds = [];
        foreach ($validatedData['rules'] as $ruleId) {
            if (!$team->taxRules()->where('id', $ruleId)->exists()) {
                return redirect()->back()->withErrors(['error' => 'The specified tax rule does not exist or is not associated with the current team.']);
            }
            $ruleIds[] = $ruleId;
        }
        $taxGroup->rules()->sync($ruleIds);

        return redirect()->route('tax-groups.index');
    }

    public function destroy(TaxGroup $taxGroup)
    {
        $taxGroup->delete();

        return redirect()->route('tax-groups.index');
    }
}

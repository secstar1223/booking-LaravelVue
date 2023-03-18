namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EquipmentGuide;

class EquipmentGuideController extends Controller
{
    public function store(Request $request)
    {
        $equipmentGuide = new EquipmentGuide();
        $equipmentGuide->name = $request->input('name');
        $equipmentGuide->short_name = $request->input('short_name');
        $equipmentGuide->color = $request->input('color');
        $equipmentGuide->quantity = $request->input('quantity');
        $equipmentGuide->capacity = $request->input('capacity');
        $equipmentGuide->resource_tracking = $request->input('resource_tracking', false);
        $equipmentGuide->description = $request->input('description');

        $equipmentGuide->save();

        return redirect('/equipmentguides')->with('success', 'Equipment guide created successfully.');
    }
}


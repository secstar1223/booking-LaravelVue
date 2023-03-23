<?php
namespace App\Http\Controllers;

use App\Models\Rental_Products;
use App\Models\Rental_Equipment_Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewRentalController extends Controller
{
       public function store(Request $request)
    {
        $rental_product = new Rental_Products;
        $rental_product->name = $request->input('product-name');
        $rental_product->description = $request->input('description');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $filename);
            $rental_product->image = $filename;
        }

        $rental_product->save();

         return response()->json(['id' => $rental_product->id]);
    }
    
    
	public function rentalequipmenttype(Request $request)
    {
        $display_name = $request->input('display_name');
        $equipment_pool = $request->input('equipment_pool');
        $description = $request->input('description');
        $widget_image = $request->input('widget_image');
        $widget_display = $request->input('widget_display');
        $min_value = $request->input('min_value');
        $max_value = $request->input('max_value');
        $require_min = $request->input('require_min');
        $category = $request->input('category');
        
        $Rental_Equipment_Type = new Rental_Equipment_type;
        $Rental_Equipment_Typet->display_name = $display_name;
        $Rental_Equipment_Type->equipment_pool = $equipment_pool;
        $Rental_Equipment_Type->description = $description;
        $Rental_Equipment_Type->widget_image = $widget_image;
        $Rental_Equipment_Type->widget_display = $widget_display;
        $Rental_Equipment_Type->min_value = $min_value;
        $Rental_Equipment_Type->max_value = $max_value;
        $Rental_Equipment_Type->require_min = $require_min;
        $Rental_Equipment_Type->category = $category;
		
        $Rental_Equipment_Type->save();

        return redirect('/newrental');
    }
	    
    
    
    
}



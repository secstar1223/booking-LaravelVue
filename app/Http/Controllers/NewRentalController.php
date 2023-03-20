<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewRentalController extends Controller
{
        public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->input('product-name');
        $product->description = $request->input('description');
        // Upload the image file and save the path to the database
        $product->image = 'path/to/image'; 
        $product->save();

        return redirect('/')->with('success', 'Product created successfully.');
    }

}



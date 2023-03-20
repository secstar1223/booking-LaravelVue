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

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $filename);
            $product->image = $filename;
        }

        $product->save();

        return redirect('/newrental');
    }
}



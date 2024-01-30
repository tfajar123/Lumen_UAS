<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $products = Product::OrderBy("product_id", "DESC")->paginate(10);
    
        return response()->json($products->items('data'), 200);
        
    }
    public function store(Request $request)
    {
        $contentTypeHeader = $request->header('Content-Type');

           
        $input = $request->all();
        $product = Product::create($input);
        return response()->json($product, 200);
    }
    public function show(Request $request, $product_id)
    {
        
        $product = Product::find($product_id);

            
        if(!$product) {
            abort(404);
        }
        return response()->json($product, 200);
            
    }
    public function update(Request $request, $product_id)
    {
        $input = $request->all();
        $product = Product::find($product_id);
            
        if(!$product) {
            abort(404);
        }
        $product->fill($input);
        $product->save();
        return response()->json($product, 200);

    }
    public function destroy(Request $request, $product_id)
    {
        $product = Product::find($product_id);

        if (!$product) {
            return response('Product not found', 404);
        }

        $product->delete();

        return response('Product deleted', 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $suppliers = Supplier::OrderBy("id", "DESC")->paginate(10);
    
        return response()->json($suppliers->items('data'), 200);
        
    }
    public function store(Request $request)
    {
           
        $input = $request->all();
        $supplier = Supplier::create($input);
        return response()->json($supplier, 200);
    }
    public function show(Request $request, $supplier_id)
    {
        
        $supplier = Supplier::find($supplier_id);

            
        if(!$supplier) {
            abort(404);
        }
        return response()->json($supplier, 200);
            
    }
    public function update(Request $request, $supplier_id)
    {
        $input = $request->all();
        $supplier = Supplier::find($supplier_id);
            
        if(!$supplier) {
            abort(404);
        }
        $supplier->fill($input);
        $supplier->save();
        return response()->json($supplier, 200);

    }
    public function destroy(Request $request, $supplier_id)
    {
        $supplier = Supplier::find($supplier_id);

        if (!$supplier) {
            return response('Supplier not found', 404);
        }

        $supplier->delete();

        return response('Supplier deleted', 200);
    }
}

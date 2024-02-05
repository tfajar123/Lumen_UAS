<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Auth;

class OrderController extends Controller 
{
    public function index(Request $request)
    {
        $orders = Order::Where(['users_id' => Auth::user()->id])->OrderBy("order_id", "DESC")->paginate(10);
        return response()->json($orders->items('data'), 200);
    }
    public function store(Request $request)
    {
        //dd($request->header());
        $input = $request->all();
        $order = Order::create($input);
    
        return response()->json(['data' => $order], 200);
    }

    public function show($order_id, Request $request)
    {
        
            $order = Order::find($order_id);

            if(!$order) {
                abort(404);
            }
            return response()->json($order, 200);
    }

    public function update($order_id, Request $request)
    {
            $input = $request->all();
            $order = Order::find($order_id);
            if(!$order) {
                abort(404);
            }

            $order->fill($input);
            $order->save();
            return response()->json($order, 200);
    }

    public function destroy($order_id, Request $request)
    {
        
            $order = Order::find($order_id);

            if(!$order) {
                abort(404);
            }
            $order->delete();

            $message = ['message' => 'Deleted successfully', 'order_id' => $order_id];
            return response()->json($message, 200);
            
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return response()->json(['transactions' => $transactions], 200);
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        return response()->json(['transaction' => $transaction], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'transaction_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'total_amount' => 'required|numeric',
        ]);

        $transaction = Transaction::create($request->all());

        return response()->json(['transaction' => $transaction], 201);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $this->validate($request, [
            'transaction_date' => 'date',
            'user_id' => 'exists:users,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'total_amount' => 'numeric',
        ]);

        $transaction->update($request->all());

        return response()->json(['transaction' => $transaction], 200);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $transaction->delete();

        return response()->json(['message' => 'Transaction deleted successfully'], 200);
    }
}

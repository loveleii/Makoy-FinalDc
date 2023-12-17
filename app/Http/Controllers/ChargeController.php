<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Charge;

class ChargeController extends Controller
{
    public function index()
    {
        $charges = Charge::all();
        $totalAmount = $charges->sum('amount');
        return view('charges.index', compact('charges', 'totalAmount'));
    }

    public function show($id)
    {
        $charge = Charge::findOrFail($id);
        return view('charges.show', compact('charge'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'charge_description' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        // Check if a charge with the same description exists
        $existingCharge = Charge::where('charge_description', $validatedData['charge_description'])->first();

        if ($existingCharge) {
            // If exists, update the amount
            $existingCharge->update(['amount' => $existingCharge->amount + $validatedData['amount']]);
        } else {
            // If not exists, create a new charge
            Charge::create($validatedData);
        }

        return redirect()->route('charges.index')->with('success', 'Charge created or updated successfully');
    }

}

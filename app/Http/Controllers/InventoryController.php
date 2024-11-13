<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\StockHistory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function check()
    {
        $medicines = Medicine::with('stockHistories')
            ->orderBy('stock', 'asc')
            ->get();

        $lowStock = $medicines->where('stock', '<=', 10);
        $criticalStock = $medicines->where('stock', '<=', 5);

        return view('inventory.check', compact('medicines', 'lowStock', 'criticalStock'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer',
            'type' => 'required|in:in,out',
            'notes' => 'nullable|string'
        ]);

        $medicine->stockHistories()->create([
            'quantity' => $validated['quantity'],
            'type' => $validated['type'],
            'notes' => $validated['notes'],
            'user_id' => auth()->id()
        ]);

        // Update stok
        if ($validated['type'] === 'in') {
            $medicine->increment('stock', $validated['quantity']);
        } else {
            $medicine->decrement('stock', $validated['quantity']);
        }

        return back()->with('success', 'Stok berhasil diperbarui!');
    }
} 
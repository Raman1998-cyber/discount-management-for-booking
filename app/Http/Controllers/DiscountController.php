<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    // Show the form to create a discount (GET)
     public function showCreateForm()
    {
        
        return view('create_discount');
    }

    // Method to store the new discount in the database
    public function store(Request $request)
    {
        // Validation for the discount form
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric',
            'max_uses' => 'nullable|integer',
            'max_discount' => 'nullable|numeric',
            'recurring' => 'boolean',
            'family_member' => 'boolean'
        ]);

        // Create a new discount
        Discount::create($data);

        // Redirect with a success message
        return redirect()->route('discount.create')->with('success', 'Discount created successfully!');
    }

    // Show the form to apply a discount (GET)
    public function showApplyForm()
    {
        $discounts = Discount::all();
        return view('discounts.apply_discount', compact('discounts')); // View for applying a discount
    }

    // Apply the discount (POST)
   public function applyDiscount(Request $request)
    {
        // Validate the request
        $request->validate([
            'schedule_id' => 'required|integer',
            'total_cost' => 'required|numeric',
            'discount_id' => 'required|exists:discounts,id'
        ]);

        // Find the discount
        $discount = Discount::find($request->discount_id);

        // Check if the discount was found
        if (!$discount) {
            return back()->with('error', 'Discount not found.');
        }

        // Apply the discount logic
        $totalCost = $request->total_cost;

        if ($discount->type === 'fixed') {
            $discountedTotal = max(0, $totalCost - $discount->value);
        } else {
            $discountedTotal = max(0, $totalCost - ($totalCost * $discount->value / 100));
        }

        return back()->with('success', "Discount applied! Discounted total is: $discountedTotal");
    }
}

?>
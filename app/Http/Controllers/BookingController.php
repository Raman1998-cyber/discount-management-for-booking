<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Discount; // Make sure this line is included
use Illuminate\Http\Request;
use Auth;

class BookingController extends Controller
{
    public function showBookingPage()
    {
        // Get the current authenticated user
        $user = Auth::user();
         $familyDiscount = [];
         $previousBookings = 0;
         $recurringDiscount = [];
        if( !empty($user)){
        	 // Fetch the user's previous bookings for recurring discounts
	        $previousBookings = Booking::where('user_id', $user->id)->get();
	        // Fetch applicable discounts
	        $familyDiscount = Discount::where('type', 'family_member')->first();
	        $recurringDiscount = Discount::where('type', 'recurring')->first();
	       
	        }
	        return view('user_booking', compact('user', 'previousBookings', 'familyDiscount', 'recurringDiscount'));

        
    }
    public function applyDiscount(Request $request)
    {
        // Validate the request
        $request->validate([
            'discount_id' => 'required|exists:discounts,id',
            'total_cost' => 'required|numeric'
        ]);

        // Apply discount logic based on discount ID or scenario
        $discount = Discount::find($request->input('discount_id'));

        // Calculate the final cost based on discount type
        $finalCost = $request->input('total_cost');

        if ($discount->type === 'fixed') {
            $finalCost -= $discount->value; // Fixed discount
        } elseif ($discount->type === 'percentage') {
            $finalCost -= ($finalCost * ($discount->value / 100)); // Percentage discount
        }

        // Return final cost to the view
        return redirect()->back()->with('finalCost', $finalCost)->with('success', 'Discount Applied!');
    }
}
?>
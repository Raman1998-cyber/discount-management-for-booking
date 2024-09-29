@extends('layouts.app')

@section('content')
    <h1>Booking Page</h1>

    <div>
        @if (!empty($user))
            <h2>Hello, {{ $user->name }}!</h2>
        @else
            <h2>Hello, Guest!</h2>
        @endif
        
        <form action="{{ route('booking.applyDiscount') }}" method="POST" id="booking-form">
            @csrf
            <input type="hidden" name="total_cost" value="100"> <!-- Replace with actual booking cost -->

            <!-- Journey Details -->
            <div class="mb-4">
                <label class="block">From:</label>
                <input type="text" value="Bengaluru" class="border rounded p-2 w-full" readonly>
            </div>
            <div class="mb-4">
                <label class="block">To:</label>
                <input type="text" value="Pune" class="border rounded p-2 w-full" readonly>
            </div>

            <!-- Number of Family Members -->
            <div class="mb-4">
                <label for="family-members" class="block">Number of Family Members:</label>
                <input type="number" id="family-members" name="family_members" class="border rounded p-2 w-full" onchange="validateFamilyMembers()">
            </div>

            <!-- Show Discount for Family Member -->
            @if (!empty($familyDiscount) && isset($familyDiscount->value))
                <h3>Family Member Discount</h3>
                <p>Discount: {{ $familyDiscount->value }} {{ $familyDiscount->type == 'fixed' ? 'USD' : '%' }}</p>
                <input type="radio" name="discount_id" value="{{ $familyDiscount->id }}" onchange="calculateTotal()"> Apply Family Discount
            @else
                <p>No Family Member Discount available.</p>
            @endif

            <!-- Show Discount for Recurring Booking -->
            @if (!empty($previousBookings) && $previousBookings instanceof \Illuminate\Database\Eloquent\Collection && $previousBookings->count() > 0 && !empty($recurringDiscount) && isset($recurringDiscount->value))
                <h3>Recurring Booking Discount</h3>
                <p>Discount: {{ $recurringDiscount->value }} {{ $recurringDiscount->type == 'fixed' ? 'USD' : '%' }}</p>
                <input type="radio" name="discount_id" value="{{ $recurringDiscount->id }}" onchange="calculateTotal()"> Apply Recurring Discount
            @else
                <p>No Recurring Booking Discount available.</p>
            @endif

            <br>
            <button type="submit">Apply Discount</button>
        </form>

        <!-- Show Final Price if Discount Applied -->
        <h3 id="final-cost" class="mt-6 text-lg font-semibold">Final Booking Cost: $100</h3>

        <!-- Success Message -->
        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif
    </div>

    <script>
        function validateFamilyMembers() {
            const familyMembers = parseInt(document.getElementById('family-members').value);
            if (familyMembers !== 4) {
                alert("Please enter exactly 4 family members.");
                document.getElementById('family-members').value = ''; // Reset the input
                document.getElementById('final-cost').innerText = 'Final Booking Cost: $100'; // Reset final cost
            }
        }

        function calculateTotal() {
            const baseCost = 100; // Initial cost
            let discount = 0;

            const familyMembers = parseInt(document.getElementById('family-members').value) || 0;
            if (familyMembers !== 4) {
                alert("Please enter exactly 4 family members.");
                document.getElementById('final-cost').innerText = 'Final Booking Cost: $100'; // Reset final cost
                return;
            }

            // Get selected discount
            const familyDiscount = document.querySelector('input[name="discount_id"]:checked');
            if (familyDiscount) {
                if (familyDiscount.value == "{{ $familyDiscount->id }}") {
                    discount = baseCost * ({{ $familyDiscount->value }} / 100); // Apply family discount
                } else if (familyDiscount.value == "{{ $recurringDiscount->id }}") {
                    discount = {{ $recurringDiscount->value }}; // Apply recurring discount
                }
            }

            const totalCost = baseCost - discount;
            document.getElementById('final-cost').innerText = `Final Booking Cost: $${totalCost}`;
        }
    </script>
@endsection

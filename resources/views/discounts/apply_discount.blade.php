@extends('layouts.app')

@section('content')
    <h1>Apply Discount</h1>
    <form action="{{ route('discount.apply') }}" method="POST">
        @csrf
        <label for="schedule_id">Schedule ID</label>
        <input type="number" name="schedule_id" id="schedule_id" required>

        <label for="total_cost">Total Cost</label>
        <input type="number" name="total_cost" id="total_cost" step="0.01" required>

        <label for="discount_id">Select Discount</label>
        <select name="discount_id" id="discount_id" required>
            @foreach($discounts as $discount)
                <option value="{{ $discount->id }}">{{ $discount->name }} ({{ $discount->type }} - {{ $discount->value }})</option>
            @endforeach
        </select>

        <button type="submit">Apply Discount</button>
    </form>
@endsection
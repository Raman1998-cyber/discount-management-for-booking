@extends('layouts.app')

@section('content')
    <h1>Create Discount</h1>
    <form action="{{ route('discount.store') }}" method="POST">
        @csrf
        <label for="name">Discount Name</label>
        <input type="text" name="name" id="name" required>

        <label for="type">Discount Type</label>
        <select name="type" id="type" required>
            <option value="fixed">Fixed</option>
            <option value="percentage">Percentage</option>
        </select>

        <label for="value">Discount Value</label>
        <input type="number" name="value" id="value" step="0.01" required>

        <label for="max_uses">Maximum Uses (Optional)</label>
        <input type="number" name="max_uses" id="max_uses">

        <label for="max_discount">Maximum Discount (Optional)</label>
        <input type="number" name="max_discount" id="max_discount" step="0.01">

        <label for="recurring">Recurring Discount</label>
        <input type="checkbox" name="recurring" id="recurring" value="1">

        <label for="family_member">Family Member Discount</label>
        <input type="checkbox" name="family_member" id="family_member" value="1">

        <button type="submit">Create Discount</button>
    </form>
@endsection
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply Discount</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Include Bootstrap or any other CSS framework -->
</head>
<body>
    <div class="container mt-5">
        <h2>Apply Discount</h2>
        <form action="{{ route('discount.apply') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="schedule_id">Schedule ID</label>
                <input type="number" name="schedule_id" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="total_cost">Total Cost</label>
                <input type="number" step="0.01" name="total_cost" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="discount_id">Select Discount</label>
                <select name="discount_id" class="form-control" required>
                    @foreach($discounts as $discount)
                        <option value="{{ $discount->id }}">{{ $discount->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Apply Discount</button>
        </form>
    </div>

    <script src="{{ asset('js/app.js') }}"></script> <!-- Include JavaScript files -->
</body>
</html>
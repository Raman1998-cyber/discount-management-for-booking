<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Discount</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Include Bootstrap or any other CSS framework -->
</head>
<body>
    <div class="container mt-5">
        <h2>Create a Discount</h2>
        <form action="{{ route('discount.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Discount Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="type">Discount Type</label>
                <select name="type" class="form-control" required>
                    <option value="fixed">Fixed</option>
                    <option value="percentage">Percentage</option>
                </select>
            </div>

            <div class="form-group">
                <label for="value">Discount Value</label>
                <input type="number" step="0.01" name="value" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="max_uses">Maximum Uses</label>
                <input type="number" name="max_uses" class="form-control">
            </div>

            <div class="form-group">
                <label for="max_discount">Maximum Discount Amount</label>
                <input type="number" step="0.01" name="max_discount" class="form-control">
            </div>

            <div class="form-group">
                <label for="recurring">Recurring</label>
                <input type="checkbox" name="recurring">
            </div>

            <div class="form-group">
                <label for="family_member">Family Member Discount</label>
                <input type="checkbox" name="family_member">
            </div>

            <button type="submit" class="btn btn-primary">Create Discount</button>
        </form>
    </div>

    <script src="{{ asset('js/app.js') }}"></script> <!-- Include JavaScript files -->
</body>
</html>
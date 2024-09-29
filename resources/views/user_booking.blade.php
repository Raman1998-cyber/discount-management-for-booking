<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold">Booking Page</h1>

        <div>
            <h2 class="mt-4">Hello, Guest!</h2>
            
            <form action="#" method="POST">
                <input type="hidden" name="total_cost" value="100"> <!-- Replace with actual booking cost -->

                <!-- Family Member Discount -->
                <h3 class="mt-6 text-lg font-semibold">Family Member Discount</h3>
                <p>Discount: 20% (Example)</p>
                <input type="radio" name="discount_id" value="1"> Apply Family Discount

                <!-- Recurring Booking Discount -->
                <h3 class="mt-4 text-lg font-semibold">Recurring Booking Discount</h3>
                <p>Discount: $10 (Example)</p>
                <input type="radio" name="discount_id" value="2"> Apply Recurring Discount

                <br class="mt-4">
                <button type="submit" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded">Apply Discount</button>
            </form>

            <!-- Show Final Price if Discount Applied -->
            <h3 class="mt-6 text-lg font-semibold">Final Booking Cost: $80 (Example)</h3>

            <!-- Success Message -->
            <p class="mt-4 text-green-600">Discount applied successfully!</p>
        </div>
    </div>
</body>
</html>

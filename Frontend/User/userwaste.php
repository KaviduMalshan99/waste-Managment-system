<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waste Plan Form</title>
    <link rel="stylesheet" href="userwaste.css"> <!-- Link to external CSS file -->
</head>
<body>
    <form class="waste-plan-form">
        <h1>Waste Plan</h1>
        <div class="form-group">
            <label for="waste-plan">Select a Waste Plan:</label>
            <select id="waste-plan" name="waste_plan" onchange="updatePlanDetails();">
                <option value="Flat Rate">Flat Rate</option>
                <option value="Weight-Based">Weight-Based</option>
                <option value="Recyclable Waste">Recyclable Waste</option>
            </select>
            <p id="planDescription"></p> <!-- Placeholder for plan description -->
        </div>

        <div class="form-group">
            <label for="weight">Select Weight (0kg - 100kg):</label>
            <input type="range" id="weight" name="weight" min="0" max="100" value="50">
            <output id="weightOutput">50</output> kg
        </div>

        <div class="form-group">
            <label for="frequency">Frequency of Collection (0 - 100 times):</label>
            <input type="range" id="frequency" name="frequency" min="0" max="100" value="10">
            <output id="frequencyOutput">10</output> times
        </div>

        <button type="button" onclick="calculateTotalPrice();">Calculate Total Price</button>
        <div>
            <label>Total Price:</label>
            <output id="totalPrice"></output> Rs.
        </div>

        <button type="submit">Submit Plan</button>
    </form>

    <script>
        function updatePlanDetails() {
            const wastePlanSelect = document.getElementById('waste-plan');
            const description = document.getElementById('planDescription');
            switch (wastePlanSelect.value) {
                case 'Flat Rate':
                    description.textContent = 'A fixed monthly fee for waste collection service, regardless of the volume of waste generated. Ideal for customers who prefer consistent and predictable billing. Base Price = Rs. 1000.00, Price per kg = Rs. 0.00, Discount = Rs. 10.00.';
                    break;
                case 'Weight-Based':
                    description.textContent = 'Customers are charged based on the weight of the waste collected. This option encourages waste reduction and is suitable for businesses with variable waste production. Base Price = Rs. 0.00, Price per kg = Rs. 50.00, Discount = Rs. 10.00.';
                    break;
                case 'Recyclable Waste':
                    description.textContent = 'A package designed for customers who primarily generate recyclable waste. Special pricing or discounts are provided for encouraging recycling and eco-friendly waste disposal. Base Price = Rs. 1000.00, Price per kg = Rs. 0.00, Discount = Rs. 100.00.';
                    break;
            }
        }

        function calculateTotalPrice() {
            const wastePlan = document.getElementById('waste-plan').value;
            const weight = parseInt(document.getElementById('weight').value, 10);
            const frequency = parseInt(document.getElementById('frequency').value, 10);
            let totalPrice = 0;

            switch (wastePlan) {
                case 'Flat Rate':
                    totalPrice = 1000 + (0 * weight * frequency) - 10;
                    break;
                case 'Weight-Based':
                    totalPrice = 0 + (50 * weight * frequency) - 10;
                    break;
                case 'Recyclable Waste':
                    totalPrice = 1000 + (0 * weight) - 100;
                    break;
            }

            document.getElementById('totalPrice').textContent = totalPrice.toFixed(2);
        }
    </script>
</body>
</html>

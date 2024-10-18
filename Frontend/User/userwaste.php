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
            <select id="waste-plan" name="waste_plan">
                <option value="Pay-As-You-Go"> Pay-As-You-Go </option>
                <option value="Flat Rate"> Flat Rate </option>
                <option value="Special Plan"> Special Plan </option>
            </select>
        </div>

        <div class="form-group">
            <label for="weight">Select Weight (0kg - 100kg):</label>
            <input type="range" id="weight" name="weight" min="0" max="100" value="50" oninput="weightOutput.value = weight.value">
            <output id="weightOutput">50</output> kg
        </div>

        <div class="form-group">
            <label for="frequency">Frequency of Collection (0 - 100 times):</label>
            <input type="range" id="frequency" name="frequency" min="0" max="100" value="10" oninput="frequencyOutput.value = frequency.value">
            <output id="frequencyOutput">10</output> times
        </div>

        <button type="submit">Submit Plan</button>
    </form>
</body>
</html>

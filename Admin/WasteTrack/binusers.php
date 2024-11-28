<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Waste Data</title>
    <style>
        /* Styles for the page */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ebe9e9;
            color: white;
            margin: 0;
            padding: 0;
        }

        .bincontainer {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .binheader {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .binheader input {
            padding: 10px;
            border-radius: 5px;
            border-color: black;
            width: 250px;
            margin-left: 40%;
        }

        .binheader button {
            background-color: #1C2336;
            padding: 10px 20px;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .binheader button:hover{
            background-color: #558e4c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        table,
        th,
        td {
            border: 1px solid #555;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            color: black;
        }

        th {
            background-color: #2c303a;
            color: white;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pagination button {
            background-color: #2c303a;
            padding: 10px;
            border: none;
            color: white;
            margin: 0 5px;
            cursor: pointer;
        }

        .pagination button:hover {
            background-color: #558e4c;
        }

        .pagination .current {
            background-color: #558e4c;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="bincontainer">
        <!-- Header with search and filter options -->
        <div class="binheader">
            <button onclick="window.location.href='regmap.php'">Map View</button> <!-- Redirect to map -->
            <input type="text" id="searchInput" placeholder="Search Residents...">
            <button onclick="searchResidents()">Search</button>
        </div>

        <!-- Resident Table -->
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Coordinates (Lat, Long)</th>
                </tr>
            </thead>
            <tbody id="residentTableBody">
                <!-- Data will be dynamically injected here -->
            </tbody>
        </table>

        <!-- Pagination Controls -->
        <div class="pagination">
            <button>&laquo; Previous</button>
            <button class="current">1</button>
            <button>2</button>
            <button>3</button>
            <button>...</button>
            <button>Next &raquo;</button>
        </div>
    </div>

    <script>
        let residentsData = [];

        // Fetch data from the PHP script
        fetch('fetch_Address.php')
            .then(response => response.json())
            .then(data => {
                residentsData = data; // Store the data globally
                displayResidents(residentsData); // Display the initial data
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });

        // Function to display the residents in the table
        function displayResidents(data) {
            const tableBody = document.getElementById('residentTableBody');
            
            // Clear any existing table rows
            tableBody.innerHTML = '';

            // Loop through the data and create table rows
            data.forEach(resident => {
                const row = document.createElement('tr');
                
                // Create table cells and append to the row
                row.innerHTML = `
                    <td>${resident.name}</td>
                    <td>${resident.street_address}</td>
                    <td>${resident.latitude}, ${resident.longitude}</td>
                `;
                
                // Append the row to the table body
                tableBody.appendChild(row);
            });
        }

        // Search function to filter residents by name or address
        function searchResidents() {
            const searchValue = document.getElementById('searchInput').value.toLowerCase();

            const filteredResidents = residentsData.filter(resident =>
                resident.name.toLowerCase().includes(searchValue) ||
                resident.street_address.toLowerCase().includes(searchValue)
            );

            displayResidents(filteredResidents); // Display filtered results
        }

        // Optional: Enable live search as user types
        document.getElementById('searchInput').addEventListener('input', searchResidents);
    </script>

</body>

</html>

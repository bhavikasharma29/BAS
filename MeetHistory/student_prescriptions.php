<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Prescriptions</title>
</head>
<body>
    <div class="container">
        <h2>My Prescriptions</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Date Issued</th>
                        <th>Doctor</th>
                        <th>View</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody id="prescription-table">
                    <!-- Prescriptions will be loaded here -->
                </tbody>
            </table>
        </div>
    </div>

<style>
    /* General Styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    /* Container */
    .container {
        width: 80%;
        background: white;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        text-align: center;
    }

    /* Heading */
    h2 {
        margin-bottom: 20px;
    }

    /* Table */
    .table-container {
        max-height: 250px; /* Adjust height so it fits 5 rows */
        overflow-y: auto;
        border: 1px solid #ddd;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
    }

    th {
        background-color: #007BFF;
        color: white;
        position: sticky;
        top: 0;
    }

    /* Buttons */
    .action-btn {
        display: inline-block;
        padding: 8px 12px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px;
        color: white;
        margin: 5px;
    }

    .view-btn {
        background: #007BFF;
    }

    .view-btn:hover {
        background: #0056b3;
    }

    .download-btn {
        background: #28a745;
    }

    .download-btn:hover {
        background: #218838;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch("fetch_prescriptions.php")
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById("prescription-table");
                if (data.length === 0) {
                    tableBody.innerHTML = "<tr><td colspan='4'>No prescriptions found.</td></tr>";
                    return;
                }

                data.forEach(prescription => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${prescription.date_issued}</td>
                        <td>Dr. ${prescription.doctor_name}</td>
                        <td>
                            <a href="${prescription.file_path}" target="_blank" class="action-btn view-btn">
                                View
                            </a>
                        </td>
                        <td>
                            <a href="${prescription.file_path}" download="${prescription.file_name}" class="action-btn download-btn">
                                Download
                            </a>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error("Error fetching prescriptions:", error));
    });
</script>
</body>
</html>

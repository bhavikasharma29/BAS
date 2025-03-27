<?php
// require 'db_connection.php'; // Database connection

// if (isset($_GET['doctor_id'])) {
//     $doctor_id = $_GET['doctor_id'];

//     // Fetch doctor's availability
//     $query = "SELECT * FROM doctor_availability WHERE doctor_id = '$doctor_id'";
//     $result = mysqli_query($conn, $query);

//     if (mysqli_num_rows($result) > 0) {
//         $availability = [];
//         while ($row = mysqli_fetch_assoc($result)) {
//             $availability[] = [
//                 'date' => $row['date'],
//                 'time_slot' => $row['time_slot'],
//                 'status' => $row['status']
//             ];
//         }
//         echo json_encode($availability);
//     } else {
//         echo json_encode(["message" => "No availability found"]);
//     }
// } else {
//     echo json_encode(["error" => "Invalid request"]);
// }

require 'db_connection.php'; // Database connection

if (isset($_GET['doctor_id'])) {
    $doctor_id = mysqli_real_escape_string($conn, $_GET['doctor_id']); // Prevent SQL Injection

    // Fetch doctor's availability
    $query = "SELECT * FROM doctor_availability WHERE doctor_id = '$doctor_id'";
    $result = mysqli_query($conn, $query);

    // Debugging: Print SQL query
    error_log("SQL Query: " . $query);  

    if (!$result) {
        // If the query fails, return the SQL error
        echo json_encode(["error" => "SQL Error: " . mysqli_error($conn)]);
        exit;
    }

    $rows_count = mysqli_num_rows($result);
    error_log("Rows found: " . $rows_count);

    if ($rows_count > 0) {
        $availability = [];
        while ($row = mysqli_fetch_assoc($result)) {
            error_log("Fetched Row: " . json_encode($row)); // Debugging: Print fetched row
            
            $availability[] = [
                'date' => $row['date'],
                'time_slot' => is_array($row['time_slot']) ? implode(", ", $row['time_slot']) : trim($row['time_slot']),
                'status' => $row['status']
            ];
            
        }
        echo json_encode($availability, JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(["message" => "No availability found"], JSON_UNESCAPED_UNICODE);
    }
} else {
    echo json_encode(["error" => "Invalid request"], JSON_UNESCAPED_UNICODE);
}

?>

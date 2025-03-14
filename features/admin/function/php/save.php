<?php
// Turn on error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include('../../../../db.php');

// Clean any prior output
ob_clean();
flush();

// Check if the form is submitted via AJAX (POST request)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $article = $_POST['article'];
    $description = $_POST['description'];
    $property_number = $_POST['property_number'];
    $unit_measure = $_POST['unit_measure'];
    $unit_value = $_POST['unit_value'];
    $qty_per_phy_count = $_POST['qty_per_phy_count'];
    $quantity = $_POST['quantity'];
    $value = $_POST['value'];
    $remarks = $_POST['remarks'];
    $in_charge = $_POST['in_charge']; // New field

    // Prepare SQL query to insert data into the database
    $sql = "INSERT INTO items (article, description, property_number, unit_measure, unit_value, qty_per_phy_count, quantity, value, remarks, in_charge) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


    // Prepare statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("ssssiiisss", $article, $description, $property_number, $unit_measure, $unit_value, $qty_per_phy_count, $quantity, $value, $remarks, $in_charge);

        // Execute query
        if ($stmt->execute()) {
            echo "success"; // Send success response
        } else {
            echo "Error executing query: " . $stmt->error; // Send error response to AJAX
        }

        // Close statement
        $stmt->close();
    } else {
        // If the SQL statement failed to prepare
        echo "Error preparing statement: " . $conn->error; // Send error response to AJAX
    }
}

// Close connection
$conn->close();
?>

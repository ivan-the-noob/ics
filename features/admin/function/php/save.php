<?php
// Turn on error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include('../../../../db.php');

// Clean any prior output
ob_clean();
flush();

if (isset($_POST['login'])) {
    $email = $_POST['email'] ?? '';
}

// Check if the form is submitted via AJAX (POST request)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $article = $_POST['article'];
    $description = $_POST['description'];
    $property_number = $_POST['property_number'];
    $unit_measure = $_POST['unit_measure'];
    $unit_value = $_POST['unit_value']; // Maps to 'unit_cost' in ics
    $qty_per_phy_count = $_POST['qty_per_phy_count'];
    $quantity = $_POST['quantity'];
    $value = $_POST['value'];
    $remarks = $_POST['remarks'];
    $in_charge = $_POST['in_charge']; // New field

    // Insert into `items` table
    $sql_items = "INSERT INTO items (email, article, description, property_number, unit_measure, unit_value, qty_per_phy_count, quantity, value, remarks, in_charge) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql_items)) {
        $stmt->bind_param("sssssiiisss", $email, $article, $description, $property_number, $unit_measure, $unit_value, $qty_per_phy_count, $quantity, $value, $remarks, $in_charge);

        if ($stmt->execute()) {
            // Insert into `ics` table
            $sql_ics = "INSERT INTO ics (email, quantity, unit, unit_cost, total_cost, description, inventory_item, estimated_life) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            if ($stmt_ics = $conn->prepare($sql_ics)) {
                $total_cost = $unit_value * $quantity; 
                $estimated_life = "";
                $quantity = "";
                $unit = "";
                

                $stmt_ics->bind_param("sissdsss", $email, $quantity, $unit_measure, $unit_value, $total_cost, $description, $property_number, $estimated_life);

                if ($stmt_ics->execute()) {
                    echo "success"; // Send success response
                } else {
                    echo "Error executing ICS query: " . $stmt_ics->error;
                }
                $stmt_ics->close();
            } else {
                echo "Error preparing ICS statement: " . $conn->error;
            }
        } else {
            echo "Error executing Items query: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing Items statement: " . $conn->error;
    }
}


// Close connection
$conn->close();
?>

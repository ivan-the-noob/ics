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
    $email = $_POST['email'];
    $type = $_POST['type'];
    $article = $_POST['article'];
    $description = $_POST['description'];
    $property_number = $_POST['property_number'];
    $unit_measure = $_POST['unit_measure'];
    $unit_value = $_POST['unit_value']; // Maps to 'unit_cost' in ics
    $qty_per_phy_count = $_POST['qty_per_phy_count'];
    $quantity = $_POST['quantity'];
    $value = $_POST['value'];
    $remarks = $_POST['remarks'];
    $in_charge = $_POST['in_charge'];

    // Insert into `items` table
    $sql_items = "INSERT INTO items (email, type, article, description, property_number, unit_measure, unit_value, qty_per_phy_count, quantity, value, remarks, in_charge) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql_items)) {
        $stmt->bind_param("sssssssiiiss", $email, $type, $article, $description, $property_number, $unit_measure, $unit_value, $qty_per_phy_count, $quantity, $value, $remarks, $in_charge);

        if ($stmt->execute()) {
            // 🔢 Generate the next ICS_NO (e.g., 2025-001)
            $ics_prefix = '2025-';
            $next_number = 1;

            $ics_check = $conn->query("SELECT MAX(ics_no) AS max_ics FROM ics");
            if ($ics_check && $row = $ics_check->fetch_assoc()) {
                if (!empty($row['max_ics'])) {
                    $last_number = (int)substr($row['max_ics'], 5);
                    $next_number = $last_number + 1;
                }
            }

            $ics_no = $ics_prefix . str_pad($next_number, 3, '0', STR_PAD_LEFT);

            // Insert into `ics` table
            $sql_ics = "INSERT INTO ics (ics_no, email, type, quantity, unit, unit_cost, total_cost, description, inventory_item, estimated_life) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            if ($stmt_ics = $conn->prepare($sql_ics)) {
                $total_cost = $unit_value * $quantity;
                $estimated_life = "";

                $stmt_ics->bind_param("sssissdsss", $ics_no, $email, $type, $quantity, $unit_measure, $unit_value, $total_cost, $description, $property_number, $estimated_life);

                if ($stmt_ics->execute()) {
                    echo "success";
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

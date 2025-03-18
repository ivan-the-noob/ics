<?php
require '../../../../db.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $accountable_officer = $_POST['accountable_officer'];
    $official_description = $_POST['official_description'];
    $agency_office = $_POST['agency_office'];
    $year = $_POST['year'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $tel_no = $_POST['tel_no'];

    // Check if the ID exists in the database
    $check_sql = "SELECT id FROM pdf_info WHERE id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // Update query
        $sql = "UPDATE pdf_info 
                SET accountable_officer=?, official_description=?, agency_office=?, year=?, address=?, email=?, tel_no=? 
                WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssi", $accountable_officer, $official_description, $agency_office, $year, $address, $email, $tel_no, $id);

        if ($stmt->execute()) {
            header("Location: ../../web/semi-expandable.php"); // Redirect after update
            exit();
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: Record not found.";
    }

    $check_stmt->close();
}

$conn->close();
?>

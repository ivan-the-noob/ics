<?php
require 'db.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountable_officer = $_POST['accountable_officer'];
    $official_description = $_POST['official_description'];
    $agency_office = $_POST['agency_office'];
    $year = $_POST['year'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $tel_no = $_POST['tel_no'];

    // Prepared statement to prevent SQL injection
    $sql = "INSERT INTO pdf_info (accountable_officer, official_description, agency_office, year, address, email, tel_no) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisss", $accountable_officer, $official_description, $agency_office, $year, $address, $email, $tel_no);

    if ($stmt->execute()) {
        header("Location: index.php?success=1"); // Redirect after successful insertion
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<?php
include '../../../../db.php'; // Make sure this file connects to your database

if (isset($_POST['submit'])) {
    $school = $_POST['school_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password

    $sql = "INSERT INTO users (school_name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $school, $email, $password);

    if ($stmt->execute()) {
        // Redirect to login page or another page after successful signup
        header("Location: ../../../../signup.php?success=1"); // Change 'login.php' to your desired page
        exit(); // Ensure no further code is executed after redirection
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>

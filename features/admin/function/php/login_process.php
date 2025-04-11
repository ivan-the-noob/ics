<?php
session_start();
include '../../../../db.php'; // Make sure this path is correct for your project

// Uncomment below for debugging if needed
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if (isset($_POST['login'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['email'] = $user['email'];
                header("Location: ../../web/semi-expandable.php");
                exit();
            } else {
                header("Location: ../../../../index.php?error=1");
                exit();
            }
        } else {
            header("Location: ../../../../index.php?error=1");
            exit();
        }

        $stmt->close();
    } else {
        // fallback if prepare fails
        header("Location: ../../../../index.php?error=1");
        exit();
    }

    $conn->close();
} else {
    header("Location: ../../../../index.php");
    exit();
}

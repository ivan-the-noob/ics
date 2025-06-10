<?php
    // db.php
    // $servername = "localhost";
    // $username = "root"; // your database username
    // $password = ""; // your database password
    // $dbname = "ics"; // your database name

    $servername = "localhost";
    $username = "u373116035_ics"; // your database username
    $password = "#sangley2323"; // your database password
    $dbname = "u373116035_ics"; // your database name



    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>

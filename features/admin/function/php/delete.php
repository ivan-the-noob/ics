<?php
include('../../../../db.php');

// Get the ID to delete
$id = $_POST['id'];

// Delete the item from the database
$sql = "DELETE FROM ics WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ../../web/ics.php"); // Redirect after delete
exit();
?>

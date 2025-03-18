<?php
include('../../../../db.php');

// Get data from form
$id = $_POST['id'];
$quantity = $_POST['quantity'];
$unit = $_POST['unit'];
$unit_cost = $_POST['unit_cost'];
$description = $_POST['description'];
$inventory_item = $_POST['inventory_item'];
$estimated_life = $_POST['estimated_life'];

// Update the item in the database
$sql = "UPDATE ics SET quantity=?, unit=?, unit_cost=?, description=?, inventory_item=?, estimated_life=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssssi", $quantity, $unit, $unit_cost, $description, $inventory_item, $estimated_life, $id);
$stmt->execute();

header("Location: ../../web/ics.php"); // Redirect after update
exit();
?>

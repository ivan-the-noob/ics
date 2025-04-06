<?php
include('../../../../db.php');

$id = $_POST['id'];
$quantity = $_POST['quantity'];
$unit = $_POST['unit'];
$unit_cost = $_POST['unit_cost']; 
$description = $_POST['description'];
$inventory_item = $_POST['inventory_item'];
$estimated_life = $_POST['estimated_life'];

$imagePath = null;

// Check if an image was uploaded and handle file upload errors
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    // Define the directory for uploaded images (no ../../ in the path)
    $uploadDir = '../../../../assets/images/';  // Store images in this folder

    // Get the image file name and extension
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageName = $_FILES['image']['name'];
    $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);

    // Generate a unique filename using uniqid() and append the file extension
    $uniqueImageName = uniqid('img_', true) . '.' . $imageExt;

    // Set the full path for the new image (no ../../)
    $imagePath = $uniqueImageName;  // Only store the file name, not the path

    // Move the uploaded file to the destination folder
    if (move_uploaded_file($imageTmpName, $uploadDir . $imagePath)) {
        // Image uploaded successfully
    } else {
        // Error uploading image
        echo "Error uploading image.";
        exit();
    }
} elseif (isset($_FILES['image']) && $_FILES['image']['error'] != 4) {
    // If there's any error in file upload except "no file uploaded" (error code 4)
    echo "File upload error: " . $_FILES['image']['error'];
    exit();
}

// Prepare the SQL query to update the item
if ($imagePath) {
    // If an image was uploaded, update the record with the new image path (only the filename)
    $sql = "UPDATE ics SET quantity=?, unit=?, unit_cost=?, description=?, inventory_item=?, estimated_life=?, image=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    // Correct number of parameters: 8 in total (7 string fields + 1 integer for ID)
    $stmt->bind_param("sssssssi", $quantity, $unit, $unit_cost, $description, $inventory_item, $estimated_life, $imagePath, $id);
} else {
    // If no image was uploaded, update without changing the image
    $sql = "UPDATE ics SET quantity=?, unit=?, unit_cost=?, description=?, inventory_item=?, estimated_life=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    // Correct number of parameters: 7 in total (6 string fields + 1 integer for ID)
    $stmt->bind_param("ssssssi", $quantity, $unit, $unit_cost, $description, $inventory_item, $estimated_life, $id);
}

// Execute the query and check for errors
if ($stmt->execute()) {
    // Successfully updated
    header("Location: ../../web/ics.php");
    exit();
} else {
    // Error executing query, display the error message
    echo "Error executing query: " . $stmt->error;
    exit();
}
?>

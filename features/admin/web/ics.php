<?php 
session_start();

// Now you can safely include other files and start using $_SESSION
include('../../../db.php');


$userEmail = $_SESSION['email']; // Safe to use $_SESSION['email']
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="d-flex">
<div class="navbar d-flex justify-content-start flex-column shadow-sm p-3 collapse show" id="navbar">
            <div class="navbar-header d-flex justify-content-between align-items-center w-100">
                <a class="navbar-brand d-none d-md-block logo-container" href="#">
                    <img src="../../../assets/logo.png" alt="Logo">
                </a>
            </div>
            <div class="navbar-links">
               
                <a href="semi-expandable.php">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Semi-Expandable Property</span>
                </a>
                <a href="par.php">
                    <i class="fa-solid fa-clock"></i>
                    <span>Property Acknowledgement Receipt</span>
                </a>
                <a href="ics.php" class="navbar-highlight">
                    <i class="fa-solid fa-clock"></i>
                    <span>ICS SEMI</span>
                </a>
                <a href="ics-par.php">
                    <i class="fa-solid fa-clock"></i>
                    <span>ICS PAR</span>
                </a>
           
           
                    <a href="../function/php/logout.php">
                        <i class="fa-solid fa-clock"></i>
                        <span>Logout</span>   
                    </a>
   
            </div>
            
</div>
<div class="container">
    <h3 class="text-center p-4">INVENTORY CUSTODIAN SLIP</h3>

    
    <div class="d-flex justify-content-end">
   
</div>
<?php
$userEmail = $_SESSION['email'];

$sql = "SELECT * FROM ics WHERE email = ? AND type = 'semi-expandable'";
$stmt = $conn->prepare($sql);

// Add this to debug:
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();
?>




<table class="table table-light">
    <thead>
        <tr>
            <th rowspan="2" class="text-center">Quantity</th>
            <th rowspan="2" class="text-center">Unit</th>
            <th colspan="2" class="text-center">Amount</th>
            <th rowspan="2" class="text-center">Description</th>
            <th rowspan="2" class="text-center">Inventory Item No.</th>
            <th rowspan="2" class="text-center">Estimated Useful Life</th>
            <th rowspan="2" class="text-center">Image</th>
            <th rowspan="2" class="text-center">Actions</th>
        </tr>
        <tr>
            <th class="text-center">Unit Cost</th>
            <th class="text-center">Total Cost</th>
        </tr>
    </thead>
    <tbody>
    <?php
        // Check if there are results
        if ($result->num_rows > 0) {
            // Loop through each row and display in table
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                echo "<td>" . htmlspecialchars($row['unit']) . "</td>";
                echo "<td>₱" . number_format($row['unit_cost'], 2) . "</td>";
                echo "<td>₱" . number_format($row['quantity'] * $row['unit_cost'], 2) . "</td>";
                echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                echo "<td>" . htmlspecialchars($row['inventory_item']) . "</td>";
                echo "<td>" . htmlspecialchars($row['estimated_life']) . "</td>";
                
                // Display image if exists and trigger modal on click
                echo "<td class='text-center'>";
                if (!empty($row['image'])) {
                    echo "<a href='#' data-bs-toggle='modal' data-bs-target='#imageModal" . $row['id'] . "'>";
                    echo "<img src='../../../assets/images/" . htmlspecialchars($row['image']) . "' alt='Image' width='50' height='50'>";
                    echo "</a>";
                } else {
                    echo "No image";
                }
                echo "</td>";

                // Update and Delete buttons
                echo "<td><div class='d-flex gap-1 mx-auto justify-content-center'>
                        <button class='btn btn-warning text-white' data-bs-toggle='modal' data-bs-target='#updateModal' data-id='" . $row['id'] . "' data-quantity='" . $row['quantity'] . "' data-unit='" . $row['unit'] . "' data-unit_cost='" . $row['unit_cost'] . "' data-description='" . $row['description'] . "' data-inventory_item='" . $row['inventory_item'] . "' data-estimated_life='" . $row['estimated_life'] . "'>Update</button>
                        <button class='btn btn-danger text-white' data-bs-toggle='modal' data-bs-target='#deleteModal' data-id='" . $row['id'] . "'>Delete</button>
                        <a href='../function/php/download_excel.php?id=" . $row['id'] . "' class='btn btn-success text-white'>Download</a>
                      </div></td>";
                echo "</tr>";

                // Modal structure for the image
                if (!empty($row['image'])) {
                    echo "
                    <div class='modal fade' id='imageModal" . $row['id'] . "' tabindex='-1' aria-labelledby='imageModalLabel" . $row['id'] . "' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='imageModalLabel" . $row['id'] . "'>Image</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                    <!-- Zoomed-in image -->
                                    <img src='../../../assets/images/" . htmlspecialchars($row['image']) . "' class='img-fluid' alt='Image'>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
                }

            }
        } else {
            // If no records are found
            echo "<tr><td colspan='9'>No data found</td></tr>";
        }
    ?>
</tbody>

</table>


<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="../function/php/update.php" method="POST" enctype="multipart/form-data">  
                    <input type="hidden" id="updateId" name="id">
                    <div class="mb-3">
                        <label for="updateQuantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="updateQuantity" name="quantity">
                    </div>
                    <div class="mb-3">
                        <label for="updateUnit" class="form-label">Unit</label>
                        <input type="text" class="form-control" id="updateUnit" name="unit">
                    </div>
                    <div class="mb-3">
                        <label for="updateUnitCost" class="form-label">Unit Cost</label>
                        <input type="number" class="form-control" id="updateUnitCost" name="unit_cost" step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="updateDescription" class="form-label">Description</label>
                        <input type="text" class="form-control" id="updateDescription" name="description">
                    </div>
                    <div class="mb-3">
                        <label for="updateInventoryItem" class="form-label">Inventory Item No.</label>
                        <input type="text" class="form-control" id="updateInventoryItem" name="inventory_item">
                    </div>
                    <div class="mb-3">
                        <label for="updateEstimatedLife" class="form-label">Estimated Useful Life</label>
                        <input type="text" class="form-control" id="updateEstimatedLife" name="estimated_life">
                    </div>
                    <div class="mb-3">
                        <label for="updateImage" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="updateImage" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" action="../function/php/delete.php" method="POST">
                    <input type="hidden" id="deleteId" name="id">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // For Update modal
    var updateModal = document.getElementById('updateModal');
    updateModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var quantity = button.getAttribute('data-quantity');
        var unit = button.getAttribute('data-unit');
        var unitCost = button.getAttribute('data-unit_cost');
        var description = button.getAttribute('data-description');
        var inventoryItem = button.getAttribute('data-inventory_item');
        var estimatedLife = button.getAttribute('data-estimated_life');

        // Set the modal input fields with the data
        document.getElementById('updateId').value = id;
        document.getElementById('updateQuantity').value = quantity;
        document.getElementById('updateUnit').value = unit;
        document.getElementById('updateUnitCost').value = unitCost;
        document.getElementById('updateDescription').value = description;
        document.getElementById('updateInventoryItem').value = inventoryItem;
        document.getElementById('updateEstimatedLife').value = estimatedLife;
    });

    // For Delete modal
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        
        // Set the delete form with the selected ID
        document.getElementById('deleteId').value = id;
    });
</script>


<?php
// Close the database connection
$conn->close();
?>


</div>
   </div>     


    
</body>
<script>
   $(document).ready(function() {
    // Check if the page was reloaded after a successful submission
    if (localStorage.getItem('showToast')) {
        $('#toast').fadeIn().delay(3000).fadeOut();
        localStorage.removeItem('showToast'); // Remove the flag after showing the toast
    }

    // Handle form submission
    $('#addItemForm').submit(function(e) {
        e.preventDefault(); // Prevent form from submitting normally
        
        var formData = $(this).serialize(); // Serialize form data
        
        $.ajax({
            url: '../function/php/save.php',  // Your PHP file for saving data
            type: 'POST',
            data: formData,
            success: function(response) {
                // Check if response is empty
                if (response.trim() === '') {
                    console.error("Server returned an empty response.");
                } else {
                    console.log("Server Response: ", response); // Log the server response in console
                
                    // Check if the response is 'success' (success message from PHP)
                    if (response.trim() === 'success') {
                        localStorage.setItem('showToast', 'true'); // Set flag before reloading
                        location.reload(); // Reload the page immediately
                    }
                }
            },
            error: function(xhr, status, error) {
                // Log detailed error info in console
                console.error('AJAX Error: ', error);   // Log the error type (status)
                console.error('Response Text: ', xhr.responseText); // Log the response text (may contain error info)
            }
        });
    });
});


</script>
</html>
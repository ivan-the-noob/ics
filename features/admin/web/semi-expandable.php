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
                <a href="dashboard.php">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Dashboard</span>
                </a>
                <a href="semi-expandable.php" class="navbar-highlight">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Semi-Expandable Property</span>
                </a>
                <a href="property-plant.php">
                    <i class="fa-solid fa-clock"></i>
                    <span>Property Plant and Equipment</span>
                </a>
                  <a href="ics.php">
                    <i class="fa-solid fa-clock"></i>
                    <span>ICS</span>

                    
                </a>
               
            </div>
            
</div>
<div class="container">
    <h3 class="text-center p-4">Semi Expandable Property</h3>

    
    <div class="d-flex justify-content-end gap-1">
    <button type="button" class="btn btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#pdfModal">
        Edit PDF Content
    </button>
    <a href="../../../generate_pdf.php" class="btn btn-danger mb-2">Save as PDF</a>
    <a href="../../../generate_pdf.php" class="btn btn-success mb-2">Save as EXCEL</a>
    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Edit PDF Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
            <?php
            require '../../../db.php'; // Include database connection

            // Fetch record where id = 1
            $id = 1; // Change this if needed
            $sql = "SELECT * FROM pdf_info WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc(); // Fetch as associative array

            $stmt->close();
            $conn->close();
            ?>

                <form action="../function/php/pdf_info.php" method="POST">
                    <!-- Hidden input for ID -->
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">

                    <div class="mb-3">
                        <label class="form-label">Accountable Officer</label>
                        <input type="text" name="accountable_officer" class="form-control" required value="<?= htmlspecialchars($row['accountable_officer']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Official Description</label>
                        <input type="text" name="official_description" class="form-control" required value="<?= htmlspecialchars($row['official_description']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Agency/Office</label>
                        <input type="text" name="agency_office" class="form-control" required value="<?= htmlspecialchars($row['agency_office']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Year</label>
                        <input type="text" name="year" class="form-control" required value="<?= htmlspecialchars($row['year']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" required value="<?= htmlspecialchars($row['address']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($row['email']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telephone Number</label>
                        <input type="tel" name="tel_no" class="form-control" required value="<?= htmlspecialchars($row['tel_no']) ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addItemModal">Add New</button>
    <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-size">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel">Add New Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>  
            <div class="modal-body">
            <form id="addItemForm">
            <div class="d-flex  gap-2">
            <div class="mb-3 w-50">
                <label for="article" class="form-label">Article</label>
                <select class="form-control" id="article" name="article" required>
                    <option value="" disabled selected>Select Article</option>
                    <option value="SEMI-EXPENDABLE OFFICE EQUIPMENT">SEMI-EXPENDABLE OFFICE EQUIPMENT</option>
                    <option value="SEMI-EXPENDABLE TECHNICAL & SCIENTIFIC EQUIPMENT">SEMI-EXPENDABLE TECHNICAL & SCIENTIFIC EQUIPMENT</option>
                    <option value="SEMI-EXPENDABLE ICT EQUIPMENT">SEMI-EXPENDABLE ICT EQUIPMENT</option>
                    <option value="SEMI-EXPENDABLE FURNITURE & FIXTURES">SEMI-EXPENDABLE FURNITURE & FIXTURES</option>
                    <option value="SEMI-EXPENDABLE OTHER MACHINERY & EQUIPMENT">SEMI-EXPENDABLE OTHER MACHINERY & EQUIPMENT</option>
                    <option value="SEMI-EXPENDABLE MEDICAL EQUIPMENT">SEMI-EXPENDABLE MEDICAL EQUIPMENT</option>
                    <option value="SEMI-EXPENDABLE SPORTS EQUIPMENT">SEMI-EXPENDABLE SPORTS EQUIPMENT</option>
                    <option value="SEMI-EXPENDABLE BOOKS">SEMI-EXPENDABLE BOOKS</option>
                </select>
            </div>

                <div class="mb-3 w-50">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
            </div>
            <div class="d-flex gap-2">
                <div class="mb-3 w-50">
                    <label for="property_number" class="form-label">Property Number</label>
                    <input type="text" class="form-control" id="property_number" name="property_number" required>
                </div>
                <div class="mb-3 w-50">
                    <label for="unit_measure" class="form-label">Unit Measure</label>
                    <input type="text" class="form-control" id="unit_measure" name="unit_measure" required>
                </div>
            </div>
            <div class="d-flex gap-2">
                <div class="mb-3 w-50">
                    <label for="unit_value" class="form-label">Unit Value</label>
                    <input type="number" class="form-control" id="unit_value" name="unit_value" required>
                </div>
                <div class="mb-3 w-50">
                    <label for="qty_per_phy_count" class="form-label">Quantity per Physical Count</label>
                    <input type="number" class="form-control" id="qty_per_phy_count" name="qty_per_phy_count" required>
                </div>
            </div>
            <div class="d-flex gap-2">
                <div class="mb-3 w-50">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity">
                </div>
                <div class="mb-3 w-50">
                    <label for="value" class="form-label">Value</label>
                    <input type="number" class="form-control" id="value" name="value">
                </div>
            </div>
            <div class="d-flex gap-2">
                <div class="mb-3 w-50">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                </div>
                <div class="mb-3 w-50">
                    <label for="remarks" class="form-label">Person In-charge</label>
                    <input type="text" class="form-control" id="in_charge" name="in_charge" required>
                </div>
            </div>
                <button type="submit" class="btn btn-primary w-50 d-flex mx-auto align-items-center justify-content-center text-center">Submit</button>
            </form>

            </div>
            </div>
        </div>
        </div>
    </div>
    <div id="toast" class="toast bg-success text-white" style="display: none;">
    <div class="toast-body">
        New Semi-Expandable added.
    </div>
</div>
<?php
// Include database connection file
include('../../../db.php');

// Query to fetch data from items table
$sql = "SELECT * FROM items";
$result = $conn->query($sql);

?>

<table class="table table-light">
    <thead>
        <tr style="border-top: none;">
            <th rowspan="2" class="text-center">Article</th>
            <th rowspan="2" class="text-center">Description</th>
            <th rowspan="2" class="text-center">Property Number</th>
            <th rowspan="2" class="text-center">Unit Measure</th>
            <th rowspan="2" class="text-center">Unit Value</th>
            <th rowspan="2" class="text-center">Quantity per Physical Count</th>
            <th colspan="2" class="text-center" style="border:none; padding-left: 40px;">Shortage/Overage</th>
            <th rowspan="2" class="text-center">Remarks</th>
        </tr>
        <tr>
            <th>Quantity</th>
            <th>Value</th>
        </tr>
       
    </thead>
    <tbody>
    <?php
        // Check if there are results
        if ($result->num_rows > 0) {
            // Loop through each row and display in table
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['article']) . "</td>";
                echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                echo "<td>" . htmlspecialchars($row['property_number']) . "</td>";
                echo "<td>" . htmlspecialchars($row['unit_measure']) . "</td>";
                echo "<td>₱" . number_format($row['unit_value'], 2) . "</td>";
                echo "<td>" . htmlspecialchars($row['qty_per_phy_count']) . "</td>";
                echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";

                // Check if value is a whole number and format it accordingly
                $value = $row['value'];
                if (floor($value) == $value) {
                    // If it's a whole number, display without decimals
                    echo "<td>" . floor($value) . "</td>";
                } else {
                    // Otherwise, display with decimals
                    echo "<td>" . number_format($value, 2) . "</td>";
                }

                echo "<td class='text-center'>" . htmlspecialchars($row['remarks']) . " <br><hr> " . htmlspecialchars($row['in_charge']) . "</td>";

                echo "</tr>";
            }
        } else {
            // If no records are found
            echo "<tr><td colspan='9'>No data found</td></tr>";
        }
        ?>

    </tbody>
</table>

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
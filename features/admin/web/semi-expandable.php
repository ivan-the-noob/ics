<?php 
session_start();

// Now you can safely include other files and start using $_SESSION
include('../../../db.php');

// Check if the session is valid (if the user is logged in)
if (!isset($_SESSION['email'])) {
    header("Location: ../../../index.php"); // Redirect if not logged in
    exit();
}

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.16/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>


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

                <a href="../function/php/logout.php">
                    <i class="fa-solid fa-clock"></i>
                    <span>Logout</span>   
                </a>
               
               
            </div>
            
</div>
<div class="container">
    <h3 class="text-center p-4">Semi Expandable Property</h3>

    
    <div class="d-flex justify-content-end gap-1">
    <button type="button" class="btn btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#pdfModal">
        Edit PDF Content
    </button>
    <a href="javascript:void(0);" class="btn btn-danger mb-2" id="save-pdf">Save as PDF</a>
    <button id="export-excel" class="btn btn-success mb-2">Save as EXCEL</button>
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
   
    include('../../../db.php');

    // Query to fetch data from items table
    $sql = "SELECT * FROM items WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();
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
                echo "<td>P" . number_format($row['unit_value'], 2) . "</td>";
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
            echo "<tr><td colspan='9'></td></tr>";
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
document.getElementById("export-excel").addEventListener("click", function () {
    // Select the table
    var table = document.querySelector("table");

    // Convert table to worksheet
    var wb = XLSX.utils.table_to_book(table, {sheet: "Semi Expandable Property"});

    // Save to file 
    XLSX.writeFile(wb, "semi_expandable_property.xlsx");
});
</script>

<script>
  document.getElementById('save-pdf').addEventListener('click', function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF({ orientation: "landscape" });

    // Set font to Roboto with a normal weight
    doc.setFont("Roboto");

    const headerLines = [
      "Republic of the Philippines",
      "Department of Education",
      "REGION IV-A CALABARZON",
      "SCHOOLS DIVISION OFFICE OF CAVITE CITY",
      "SANGLEY ELEMENTARY SCHOOL",
      "SANGLEY POINT, CAVITE CITY"
    ];

    const reportLines = [
      "REPORT ON THE PHYSICAL COUNT OF SEMI EXPENDABLE PROPERTY",
      "I.C.T. EQUIPMENT",
      "(type of Property, Plant and Equipment)",
      "As of DECEMBER 31, 2023"
    ];

    const additionalParagraph = [
      "Fund Cluster: Department of Education-SDO Cavite City"
    ];

    // Set font size for the header
    doc.setFontSize(10);

    const pageWidth = doc.internal.pageSize.getWidth();
    let currentY = 10;
    const margin = 15;

    // Header
    headerLines.forEach(line => {
      const textWidth = doc.getTextWidth(line);
      const x = (pageWidth - textWidth) / 2;
      doc.text(line, x, currentY);
      currentY += 5;
    });

    // Divider
    currentY += 2;
    doc.setLineWidth(0.3);
    doc.line(margin, currentY, pageWidth - margin, currentY);
    currentY += 7;

    // Report Title with special formatting
    doc.setFontSize(11);

    // Line 1: Bold with weight 700
    doc.setFont("Roboto", "normal", 700);
    let text1 = reportLines[0];
    let text1Width = doc.getTextWidth(text1);
    doc.text(text1, (pageWidth - text1Width) / 2, currentY);
    currentY += 5;

    // Line 2: Bold with weight 700 + Underline
    let text2 = reportLines[1];
    let text2Width = doc.getTextWidth(text2);
    let text2X = (pageWidth - text2Width) / 2;
    doc.text(text2, text2X, currentY);
    doc.line(text2X, currentY + 1, text2X + text2Width, currentY + 1); // underline
    currentY += 5;

    // Line 3: Normal
    doc.setFont("Roboto", "normal");
    let text3 = reportLines[2];
    let text3Width = doc.getTextWidth(text3);
    doc.text(text3, (pageWidth - text3Width) / 2, currentY);
    currentY += 5;

    // Line 4: Bold with weight 700 + partial underline
    doc.setFont("Roboto", "normal", 700);
    const fullText4 = reportLines[3]; // "As of DECEMBER 31, 2023"
    const prefix4 = "As of ";
    const underlined4 = "DECEMBER 31, 2023";

    let prefixWidth = doc.getTextWidth(prefix4);
    let underlineWidth = doc.getTextWidth(underlined4);
    let totalWidth = prefixWidth + underlineWidth;
    let startX = (pageWidth - totalWidth) / 2;

    doc.text(prefix4, startX, currentY);
    doc.text(underlined4, startX + prefixWidth, currentY);
    doc.line(startX + prefixWidth, currentY + 1, startX + prefixWidth + underlineWidth, currentY + 1); // underline
    currentY += 7;

    // Additional paragraph
    doc.setFont("Roboto", "normal");
    doc.setFontSize(10);
    doc.text(additionalParagraph[0], margin, currentY);
    currentY += 5;

    // Underlined officer info
    let baseLine = "From which ";
    let underlineParts = [
      "LOUIE G. VERGARA",
      "SCHOOL PROPERTY CUSTODIAN",
      "SANGLEY ELEMENTARY SCHOOL"
    ];

    let x = margin;
    doc.text(baseLine, x, currentY);
    x += doc.getTextWidth(baseLine);

    underlineParts.forEach((text, i) => {
      doc.text(text, x, currentY);
      doc.line(x, currentY + 1, x + doc.getTextWidth(text), currentY + 1);
      x += doc.getTextWidth(text);

      const punctuation = i === 2 ? " is accountable, having assumed such on " : ", ";
      doc.text(punctuation, x, currentY);
      x += doc.getTextWidth(punctuation);
    });

    const janText = "January 2023";
    doc.text(janText, x, currentY);
    doc.line(x, currentY + 1, x + doc.getTextWidth(janText), currentY + 1);
    currentY += 5;

    doc.text("                       (Name of Accountable Officer)          (Official Description)            (Agency Office)", margin, currentY);
    currentY += 5;

    // Table
    const table = document.querySelector('table');

    doc.autoTable({
      html: table,
      startY: currentY + 5,
      styles: {
        font: 'Roboto',
        fillColor: false,
        textColor: [0, 0, 0],
        lineWidth: 0.2,
        lineColor: [0, 0, 0],
        fontSize: 10,
        halign: 'center'
      },
      headStyles: {
        font: 'Roboto',
        fillColor: false,
        textColor: [0, 0, 0],
        lineWidth: 0.2,
        lineColor: [0, 0, 0],
      },
      bodyStyles: {
        font: 'Roboto',
        fillColor: false,
        textColor: [0, 0, 0],
        lineWidth: 0.2,
        lineColor: [0, 0, 0],
      }
    });

    // Footer: Address, Email, Tel No. formatting
    const footerText = [
      { label: "Address: ", value: "Riego De Dios Street, Sangley Point, Cavite City - 4100" },
      { label: "Email: ", value: "sangleyelementaryschool@gmail.com" },
      { label: "Tel No. ", value: "(046) 431-7187" }
    ];

    // Add footer
    footerText.forEach((line, index) => {
      const labelWidth = doc.getTextWidth(line.label);
      let x = margin;

      // Bold for Address, Email, Tel No. labels only
      doc.setFont("Roboto", "normal", 500);  // Set font to bold (weight 700) for labels only
      doc.text(line.label, x, doc.internal.pageSize.height - 15 + (index * 5));
      x += labelWidth;

      // For email, change color to blue and underline it
      if (line.label === "Email: ") {
        doc.setTextColor(0, 0, 255); // Set blue color for email
        doc.text(line.value, x, doc.internal.pageSize.height - 15 + (index * 5));
        const emailWidth = doc.getTextWidth(line.value);
        doc.setLineWidth(0.3);
        doc.line(x, doc.internal.pageSize.height - 15 + (index * 5) + 1, x + emailWidth, doc.internal.pageSize.height - 15 + (index * 5) + 1); // Underline
        doc.setTextColor(0, 0, 0); // Reset text color back to black for the next line
      } else {
        // For other labels (Address, Tel No.), normal font color
        doc.setTextColor(0, 0, 0); 
        doc.text(line.value, x, doc.internal.pageSize.height - 15 + (index * 5));
      }
    });

    // Add a footer line with margin and black color
    const footerLineY = doc.internal.pageSize.height - 22; // Position for the footer line
    doc.setLineWidth(0.5); // Line width
    doc.setDrawColor(0, 0, 0); // Ensure the line is black
    doc.line(margin, footerLineY, pageWidth - margin, footerLineY); // Draw the line

    doc.save('table_content.pdf');
  });
</script>







<script src="jspdf.plugin.autotable.js"></script>



</html>
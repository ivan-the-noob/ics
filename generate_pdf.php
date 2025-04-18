<?php
require 'db.php'; // Include the database connection
require 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Set Dompdf options
$options = new Options();
$options->set('defaultFont', 'Arial');
$options->set('isHtml5ParserEnabled', true);

$dompdf = new Dompdf($options);

// HTML content for the PDF
$html = '
    <style>
        @font-face {
            font-family: "Old English Text MT";
            src: url("font.ttf"); /* Make sure to include this font in your project */
        }
        body { font-family: Arial, sans-serif; }
        .header { margin-bottom: 20px; }
        .header .philippines { font-family: "Old English Text MT", serif; font-size: 12px; }
        .header .deped { font-size: 18px; font-weight: bold; }
        .header .region { font-size: 16px; font-weight: bold; }
        .header .school { font-size: 14px; font-weight: bold; }
        .title { font-size: 24px; font-weight: bold; margin-top: 20px; }

        /* Use block for centering and display flex functionality */
        .flex-container {
            display: flex;
            justify-content: flex-start; /* Changed to start */
            align-items: center;
            gap: 10px; /* Controls the gap between items */
        }

        .flex-container p {
            margin: 0; /* Remove default margins to prevent extra space */
        }
    </style>
    
    <div class="header">
        <div class="philippines">Republic of the Philippines</div>
        <div class="deped">Department of Education</div>
        <div class="region">REGION IV-A CALABARZON</div>
        <div class="school">SCHOOLS DIVISION OFFICE OF CAVITE CITY</div>
        <div class="school">SANGLEY ELEMENTARY SCHOOL</div>
        <div class="school">SANGLEY POINT, CAVITE CITY</div>
    </div>
    <br>
    <br>

    <h5>REPORT ON THE PHYSICAL COUNT OF SEMI EXPANDABLE PROPERTY</h5>
    <h5 class="mb-0">TEXTBOOKS & INSTRUCTIONAL MATERIALS</h5>
    <p class="mb-3">(type of Property, Plant and Equipment)</p>

    <p style="font-weight: bold;"> As of <span style="text-decoration: underline;">DECEMBER 31, 2023</span></p>

    <p>Fund Cluster: Department of Education-SDO Cavite City</p>
    <div class="flex-container">
        <p>From which</p>
        <p name="accountable_officer">LOUIE G. VERGARA</p>
        <p name="official_description">SCHOOL PROPERTY CUSTODIAN</p>
        <p name="agency_office">SANGLEY ELEMENTARY SCHOOL</p>
        <p>is accountable, having assumed such on January 2023</p>
    </div>
';


// Load HTML into Dompdf
$dompdf->loadHtml($html);

// Set paper size to A4 and landscape orientation
$dompdf->setPaper('A4', 'landscape');

// Render the PDF
$dompdf->render();  

// Stream the PDF to the browser
$dompdf->stream("document.pdf", ["Attachment" => false]); // Change to true to force download
?>

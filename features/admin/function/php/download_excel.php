<?php
require '../../../../vendor/autoload.php'; // PhpSpreadsheet autoload

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

require '../../../../db.php';
session_start();

if (!isset($_SESSION['email'])) {
    die("User not logged in.");
}

$email = $_SESSION['email'];

// Fetch school name
$school_name = '';
$schoolQuery = $conn->prepare("SELECT school_name FROM users WHERE email = ?");
$schoolQuery->bind_param("s", $email);
$schoolQuery->execute();
$schoolResult = $schoolQuery->get_result();
if ($schoolRow = $schoolResult->fetch_assoc()) {
    $school_name = $schoolRow['school_name'];
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM ics WHERE id = $id";
    $result = $conn->query($sql);

    if ($row = $result->fetch_assoc()) {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Title (centered)
        $sheet->setCellValue('A5', 'INVENTORY CUSTODIAN SLIP');
        $sheet->mergeCells('A5:G5');
        $sheet->getStyle('A5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A5')->getFont()->setBold(true)->setSize(14);

       $sheet->mergeCells('A9:E9');
        $sheet->setCellValue('A9', 'Entity Name: ' . $school_name);
        $sheet->getStyle('A9')->getFont()->setBold(true)->setUnderline(true);

        $sheet->setCellValue('G9', 'ICS No.: ' . $row['ics_no']);
        $sheet->getStyle('G9')->getFont()->setUnderline(Font::UNDERLINE_SINGLE)->setBold(true);

        // Fund Cluster
        $sheet->mergeCells('A10:E10');
        $sheet->setCellValue('A10', 'Fund Cluster: ___________');
        $sheet->getStyle('A10')->getFont()->setBold(true);

        // Header Row
        $sheet->mergeCells('A12:A13')->setCellValue('A12', 'Quantity');
        $sheet->mergeCells('B12:B13')->setCellValue('B12', 'Unit');
        $sheet->mergeCells('C12:D12')->setCellValue('C12', 'Amount');
        $sheet->setCellValue('C13', 'Unit Cost');
        $sheet->setCellValue('D13', 'Total Cost');
        $sheet->mergeCells('E12:E13')->setCellValue('E12', 'Description');
        $sheet->mergeCells('F12:F13')->setCellValue('F12', 'Inventory Item No.');
        $sheet->mergeCells('G12:G13')->setCellValue('G12', 'Estimated Useful Life');

        $sheet->getStyle('A12:G13')->getFont()->setBold(true);
        $sheet->getStyle('A12:G13')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A12:G13')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getRowDimension(12)->setRowHeight(25);
        $sheet->getRowDimension(13)->setRowHeight(20);

        // Data Row (row 14)
        $sheet->fromArray([[
            $row['quantity'],
            $row['unit'],
            number_format($row['unit_cost'], 2),
            number_format($row['quantity'] * $row['unit_cost'], 2),
            $row['description'],
            $row['inventory_item'],
            $row['estimated_life']
        ]], NULL, 'A14');

        // Borders
        $styleArray = [
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
            ],
        ];
        $sheet->getStyle('A12:G46')->applyFromArray($styleArray);

        // Auto-size columns
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Insert image
        $imagePath = '../../../../assets/images/' . $row['image'];
        if (!empty($row['image']) && file_exists($imagePath)) {
            $drawing = new Drawing();
            $drawing->setName('Item Image');
            $drawing->setDescription('Item Image');
            $drawing->setPath($imagePath);
            $drawing->setHeight(120);
            $drawing->setCoordinates('D23');
            $drawing->setWorksheet($sheet);
        }

        // Received From
        $sheet->mergeCells('A47:D47')->setCellValue('A47', 'RECEIVED FROM:');
        $sheet->getStyle('A47')->getFont()->setBold(true);
        $sheet->getStyle('A47')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        $sheet->mergeCells('A49:D49')->setCellValue('A49', 'CATHERINE C. MELO');
        $sheet->getStyle('A49')->getFont()->setBold(true)->setUnderline(true);
        $sheet->getStyle('A49:D49')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('A50:D50')->setCellValue('A50', 'Property Custodian / Administrative Office II');
        $sheet->getStyle('A50:D50')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('A51:D51')->setCellValue('A51', 'Sangley Elementary School');
        $sheet->getStyle('A51:D51')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('A52:D52')->setCellValue('A52', '___________');
        $sheet->getStyle('A52:D52')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('A53:D53')->setCellValue('A53', 'Date');
        $sheet->getStyle('A53:D53')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('A47:D54')->applyFromArray([
            'borders' => [
                'outline' => ['borderStyle' => Border::BORDER_THIN]
            ]
        ]);

        // Received By
        $sheet->mergeCells('E47:G47')->setCellValue('E47', 'RECEIVED BY:');
        $sheet->getStyle('E47')->getFont()->setBold(true);
        $sheet->getStyle('E47')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        $sheet->mergeCells('E49:G49')->setCellValue('E49', 'MARIANNE S. FAJARDO');
        $sheet->getStyle('E49')->getFont()->setBold(true)->setUnderline(true);
        $sheet->getStyle('E49:G49')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('E50:G50')->setCellValue('E50', 'Teacher I / Guidance Teacher');
        $sheet->getStyle('E50:G50')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('E51:G51')->setCellValue('E51', 'Sangley Elementary School');
        $sheet->getStyle('E51:G51')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('E52:G52')->setCellValue('E52', '___________');
        $sheet->getStyle('E52:G52')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('E53:G53')->setCellValue('E53', 'Date');
        $sheet->getStyle('E53:G53')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('E47:G54')->applyFromArray([
            'borders' => [
                'outline' => ['borderStyle' => Border::BORDER_THIN]
            ]
        ]);

        // Output file
        $filename = "ICS_" . $row['inventory_item'] . ".xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
        exit;
    } else {
        echo "Data not found.";
    }
} else {
    echo "Invalid ID.";
}
?>

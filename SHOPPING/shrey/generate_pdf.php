<?php
require('fpdf.php');

// Get the filename from the POST request
if (isset($_POST['filename'])) {
    $filename = $_POST['filename'];
} else {
    die('Filename not provided');
}

// Check if the file exists
if (!file_exists($filename)) {
    die('File not found');
}

// Read the content of the file
$content = file_get_contents($filename);

// Create a new PDF document
$pdf = new FPDF();
$pdf->AddPage();

// Set font for the PDF
$pdf->SetFont('Arial', '', 12);

// Add the text content to the PDF
$pdf->MultiCell(0, 10, $content);

// Output the PDF, naming it after the text file (changing .txt to .pdf)
$pdfOutputName = str_replace('.txt', '.pdf', $filename);
$pdf->Output('D', $pdfOutputName); // 'D' forces download, 'I' outputs in the browser
?>
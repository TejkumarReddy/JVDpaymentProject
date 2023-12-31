<?php

require __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

if (isset($_POST['submit'])) {
    // Database connection details
    $dbHost = 'localhost';
    $dbName = 'paymentdetails';
    $dbUser = 'tej';
    $dbPassword = 'Tejkumar@717';

    // Connect to the database
    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // File upload handling
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadedFile = $_FILES['file']['tmp_name'];

        // Load the uploaded CSV file
        $spreadsheet = IOFactory::load($uploadedFile);

        // Select the first worksheet
        $worksheet = $spreadsheet->getActiveSheet();

        // Get the highest column and row numbers referenced in the worksheet
        $lastColumn = $worksheet->getHighestColumn();
        $highestColumn = Coordinate::columnIndexFromString($lastColumn);
        $highestRow = $worksheet->getHighestRow();

        // Assuming the first row contains column names
        $columns = [];
        for ($col = 1; $col <= $highestColumn; ++$col) {
            $columns[] = $worksheet->getCellByColumnAndRow($col, 1)->getValue();
        }

        // Loop through each row of the worksheet starting from row 2 (assuming row 1 has column names)
        for ($row = 2; $row <= $highestRow; ++$row) {
            // Prepare data
            $data = [];
            for ($col = 1; $col <= $highestColumn; ++$col) {
                $data[$columns[$col - 1]] = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
            }

            // Create SQL query
            $sql = "INSERT INTO studentdetails(";
            $sql .= join(', ', array_map(function ($column) {
                return "`$column`"; // Use backticks to ensure correct escaping of column names
            }, $columns)) . ") VALUES (";
            $sql .= join(', ', array_map(function ($value) use ($conn) {
                return "'" . $conn->real_escape_string($value) . "'";
            }, array_values($data))) . ")";

            // Execute the query
            if ($conn->query($sql) === TRUE) {
                echo "Data inserted successfully for row $row\n";
            } else {
                echo "Error: " . $conn->error . "\n";
            }
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "File upload failed with error code: " . $_FILES['file']['error'];
    }
}

?>

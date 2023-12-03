<?php
$conn = mysqli_connect("localhost", "tej", "Tejkumar@717", "paymentdetails");

// Initialize query with no filters
$query = "SELECT * FROM studentdetails WHERE 1";

// Check if year filter is set
if (!empty($_GET['year'])) {
    $query .= " AND Year = '{$_GET['year']}'";
}

// Check if scholarship filter is set
if (!empty($_GET['scholarship'])) {
    $query .= " AND Scholarship = '{$_GET['scholarship']}'";
}

// Check if branch filter is set
if (!empty($_GET['branch'])) {
    $query .= " AND Branch = '{$_GET['branch']}'";
}

$rows = mysqli_query($conn, $query);

echo "<table border='1'>";
echo "<tr>";
echo "<th>#</th>";
echo "<th>Admission Number</th>";
echo "<th>Name</th>";
echo "<th>Year</th>";
echo "<th>Branch</th>";
echo "<th>Scholarship</th>";
echo "<th>Caste</th>";
echo "<th>Phone Number</th>";
echo "<th>Tution Fee</th>";
echo "<th>Special Fee</th>";
echo "<th>Other Fee</th>";
echo "</tr>";

$i = 1;
foreach ($rows as $row) {
    echo "<tr>";
    echo "<td>{$i}</td>";
    echo "<td>{$row['Admission Number']}</td>";
    echo "<td>{$row['Name']}</td>";
    echo "<td>{$row['Year']}</td>";
    echo "<td>{$row['Branch']}</td>";
    echo "<td>{$row['Scholarship']}</td>";
    echo "<td>{$row['Caste']}</td>";
    echo "<td>{$row['Phone Number']}</td>";
    echo "<td>{$row['Tution fee']}</td>";
    echo "<td>{$row['Special fee']}</td>";
    echo "<td>{$row['Other fee']}</td>";
    echo "</tr>";
    $i++;
}

echo "</table>";
?>

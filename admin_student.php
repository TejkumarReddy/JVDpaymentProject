<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the admission number from the form
    $admissionNumber = $_POST["admissionNumber"];

    // Perform database query to get student data
    $conn = mysqli_connect("localhost", "tej", "Tejkumar@717", "paymentdetails");

    $query = "SELECT * FROM studentdetails WHERE `Admission Number` = '$admissionNumber'";
    $result = mysqli_query($conn, $query);

    // Display the retrieved data as a table
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table style='border-collapse: collapse; width: 100%; border: 1px solid black;'>";
        $row = mysqli_fetch_assoc($result);

        // Display headers
        echo "<tr style='border: 1px solid black;'>";
        foreach ($row as $key => $value) {
            echo "<th style='border: 1px solid black;'>{$key}</th>";
        }
        echo "</tr>";

        // Display values
        do {
            echo "<tr style='border: 1px solid black;'>";
            foreach ($row as $value) {
                echo "<td style='border: 1px solid black;'>{$value}</td>";
            }
            echo "</tr>";
        } while ($row = mysqli_fetch_assoc($result));

        echo "</table>";
    } else {
        echo "No data found for the given admission number.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Get Student Data</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            max-width: 400px;
            margin: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Get Student Data</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="admissionNumber">Admission Number:</label>
            <input type="text" class="form-control" id="admissionNumber" name="admissionNumber" placeholder="Enter Admission Number" required>
            <div class="invalid-feedback">
                Please enter the admission number.
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Get Data</button>
    </form>
</div>

<!-- Bootstrap JS and dependencies (Optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Enable Bootstrap form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

</body>
</html>

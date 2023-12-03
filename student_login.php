<?php
$conn = mysqli_connect("localhost", "tej", "Tejkumar@717", "paymentdetails");

$error_message = "";

if (!empty($_POST)) {
    $admissionNumber = $_POST['admissionNumber'];
    $phoneNumber = $_POST['phoneNumber'];

    // Check if the table and column names match your database schema
    $sql = "SELECT * FROM studentdetails WHERE `Admission Number` = '$admissionNumber' AND `Phone Number` = '$phoneNumber'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);

    if ($numRows >= 1) {
        header("Location: student_links.html");
        exit();
    } else {
        $error_message = "Invalid Admission Number or Phone Number. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Form</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Login</h2>

                    <?php if (!empty($error_message)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>

                    <form action="student_login.php" method="post">
                        <!-- Admission Number Input -->
                        <div class="form-group">
                            <label for="admissionNumber">Admission Number:</label>
                            <input type="text" class="form-control" id="admissionNumber" placeholder="Enter Admission Number" name="admissionNumber">
                        </div>

                        <!-- Phone Number Input -->
                        <div class="form-group">
                            <label for="phoneNumber">Phone Number:</label>
                            <input type="text" class="form-control" id="phoneNumber" placeholder="Enter Phone Number" name="phoneNumber">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies (Optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

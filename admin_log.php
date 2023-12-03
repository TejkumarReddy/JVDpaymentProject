<?php
$conn = mysqli_connect("localhost", "tej", "Tejkumar@717", "paymentdetails");

$error_message = ""; // Variable to store error message

if (!empty($_POST)) {
    $uname = $_POST['username'];
    $upass = $_POST['password'];

    if ($conn == true) {
        // Connection successful
        $error_message = "Connection successful"; // Update with your desired message
    }

    $sql = "SELECT * FROM admin WHERE username = '$uname' AND password = '$upass'";
    $mysqls = mysqli_query($conn, $sql);
    $no = mysqli_num_rows($mysqls);

    if ($no >= 1) {
        header("Location: admin_links.html");
    } else {
        $error_message = "Invalid username or password"; // Set error message for invalid entries
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

                    <form action="admin_log.php" method="post">
                        <!-- Username Input -->
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" placeholder="Enter Username"
                                   name="username">
                        </div>

                        <!-- Password Input -->
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter Password"
                                   name="password">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
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

<?php

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate new password
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Please enter the new password.";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "Password must have atleast 6 characters.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm the password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before updating the database
    if (empty($new_password_err) && empty($confirm_password_err)) {
        // Prepare an update statement
        $sql = "UPDATE employee 
                SET emp_pass = ? 
                WHERE emp_id = ? and emp_username = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_password, $param_id, $param_username);

            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            $param_username = $_SESSION["username"];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- <style>
        body {
            text-align: center;
        }

        .avatar {
            vertical-align: middle;
            width: 10vw;
            height: auto;
            border-radius: 50%;
        }

        .data {
            margin-left: auto;
            margin-right: auto;
        }

        table {
            width: 80%;
            padding: 5px;
            font-size: 2vw;
            margin-top: 5%;
            text-align: left;
            margin-left: auto;
            margin-right: auto;
            border-radius: 5px;
            border: 0px solid;
            border-collapse: separate;
            border-spacing: 0 15px;
            border-radius: 10px;
            padding: 10px;
        }

        tr {
            background-color: #f2f2f2;
        }
    </style> -->
</head>

<body>
    <?php
    include_once "config.php";

    if (!$link) {
        die("connection failed: ") . mysqli_connect_error();
    }
    $username = htmlspecialchars($_SESSION["username"]);
    $sql = "select emp_name as name, emp_username as uname, emp_level as level, emp_photo_url as photo from employee where emp_username='$username' ";
    $result = mysqli_query($link, $sql);

    $data1 = $data2 = $data3 = "";

    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $data1 = $row['uname'];
            $data2 = $row['name'];
            $data3 = $row['level'];
            $data4 = $row['photo'];
        }
    } else {
        echo "0 result";
    }
    mysqli_close($link);
    ?>
    <span class="align-middle" style="font-size: 40px; font-weight: bold;">Welcome</span>

    <br>
    <div class="text-center">
        <img src="Picture/<?php echo $data4 ?>" alt="No Picture" class="rounded">
    </div>
    <br><br><br><br>
    <div>
        <table class="table table-striped-columns table-hover mx-auto" style="width: 60%">
            <tr>
                <th>Full Name</th>
                <th><?php echo $data2 ?></th>
            </tr>
            <tr>
                <th>Username</th>
                <th><?php echo $data1 ?></th>
            </tr>
            <tr>
                <th>Level</th>
                <th><?php echo $data3 ?></th>
            </tr>
        </table>
    </div>
    <br><br><br><br>
    <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#resetPass" style="float: left; margin-left:12% ">
            Reset Password
        </button>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="resetPass" tabindex="-1" aria-labelledby="resetPassLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="resetPassLabel">Reset Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                            <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>


<!-- resetpass.php -->
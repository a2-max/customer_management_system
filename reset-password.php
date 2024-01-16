<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="css/default.css">

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password-Dudhauli Nishan Cable</title>
</head>

<body>
<?php

include("backend/db_connect.php");
$token = $_GET['token'];
// Error Alert
if(isset($_GET['errormsg'])){
    ?>
    <script>
       swal({
            title: "Error!",
            text: "<?php echo $_GET['errormsg'] ?>",
            icon: "error",
            });
    </script>
    <?php
}
// Success Alert
if(isset($_GET['successmsg'])){
    ?>
    <script>
       swal({
            title: "Email Sent",
            text: "<?php echo $_GET['successmsg'] ?>",
            icon: "success",
            });
    </script>
    <?php
}
?>
    <div class="site_wrapper">
        <!-- main body start -->
        <div class="main-body">
            <div class="card login-card">
                <div class="details">
                    <div class="overlayn"></div>
                    <h4 class="title">Set your new password</h4>
                    <p class="tagline">Remembered your password?</p>
                    <a href="signup.html"><button>Login Here</button></a>
                </div>
                <div class="formarea">
                    <div class="content">
                        <h4 class="title">New Password</h4>
                        <form action="backend/reset-password.php?token=<?php echo $token ?>" method="POST">
                            <div class="inputarea">
                                <input type="password" placeholder="Enter New Password" name="pass1" id="email" required>
                                <i class="fas fa-unlock-alt"></i>
                            </div>
                            <div class="inputarea">
                                <input type="password" placeholder="Confirm Password" name="pass2" id="password" required>
                                <i class="fas fa-unlock-alt"></i>
                            </div>
                            <button type="submit" name="change_pass_btn">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
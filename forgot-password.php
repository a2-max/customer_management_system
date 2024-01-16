<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password-Dudhauli Nishan Cable</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="css/default.css">

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php

    include("backend/db_connect.php");
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
                    <h4 class="title">Enter Email to Reset Password</h4>
                    <p class="tagline">Already have an account?</p>
                    <a href="login.php"><button>Login Here</button></a>
                </div>
                <div class="formarea">
                    <div class="content">
                        <h4 class="title">Enter Your Email</h4>
                        <form action="backend/forgot-password.php" method="POST">
                            <div class="inputarea">
                                <input type="email" placeholder="Email Address" name="email" id="email" autocomplete="off" required>
                                <i class="fas fa-envelope"></i>
                            </div>
                            <button type="submit" name="login-btn">Send Code</button>
                        </form>
                        <!-- <p class="social-network">Sign in with existing login credentials.</p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
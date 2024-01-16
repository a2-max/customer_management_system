<?php

include("db_connect.php");

$token = $_GET['token'];

if(isset($_POST['change_pass_btn'])){

    $pass1 = mysqli_real_escape_string($conn, $_POST['pass1']);
    $pass2 = mysqli_real_escape_string($conn, $_POST['pass2']);

    if($pass1 == $pass2){ //If Password Matched

        $get_token = "SELECT * FROM `admin` WHERE `token` = '$token'";
        $token_query = mysqli_query($conn, $get_token);
        $token_count = mysqli_num_rows($token_query);

        if($token_count > 0){ //If Token No. Exist

            $update = "UPDATE `admin` SET `password`='$pass1' WHERE `token` = '$token'";
            $update_query = mysqli_query($conn, $update);

            if($update_query){ // If Password Changed
                header("location: ../login.php?successmsg=Password Changed Successfully");

            }else{ // If Password failed to change
                header("location: ../reset-password.php?token=".$token."&errormsg=Something went wrong! Please Try Again...");
            }

        }else{  // If Token No. Do not Exist
            header("location: ../forgot-password.php?errormsg=Something went wrong! Please Try Again...");
        }
    }else{ // If Passwords Do not Match
        header("location: ../reset-password.php?token=".$token."&errormsg=Passwords Do Not Match");
    }
}

?>
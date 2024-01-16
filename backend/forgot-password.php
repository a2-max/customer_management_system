<?php
session_start();
include("db_connect.php");

if(isset($_POST['login-btn'])){
    $username = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "SELECT * FROM `admin` where `email`='$username'";
    $query = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($query);
    $result = mysqli_fetch_assoc($query);
      if($rows > 0){
      
      // Send Email Code goes Here
      $token = $result['token'];
      $subject = "Password Reset - Dudhauli Nishan Cable";
      $body = "Hello! Admin, Kindly click the link to reset your password 
              http://crm.nishancable.com.np/reset-password.php?token=".$token;


    //   Sending Email
    if(mail($username, $subject, $body)){
        header("location: ../forgot-password.php?successmsg=Check Your Mail to Reset Password");
    }else{
        header("location: ../forgot-password.php?errormsg=Failed to send Email");
    }

    } else{ //If Email not found in DB
      header("location: ../forgot-password.php?errormsg=Invalid Email Address");
    }   
  }

?>
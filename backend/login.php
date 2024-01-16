<?php
session_start();
include("db_connect.php");

if(isset($_POST['login-btn'])){
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $rand1 = rand(0, 9000000000);
    $rand2 = rand(0, 9000000000);
    $updated_token = $rand1.$rand2;

    $sql = "SELECT * FROM `admin` where `email`='$username' AND `password`='$password'";
    $query = mysqli_query($conn, $sql);
    $fetch = mysqli_fetch_assoc($query);
    $id = $fetch['id'];
    $rows = mysqli_num_rows($query);

      if($rows > 0){
       // Update Token number
      $up_token = "UPDATE `admin` SET `token`= $updated_token WHERE `id` = $id";
      $up_token_query = mysqli_query($conn, $up_token);
      header("location: ../index.php");
      $_SESSION['loggedin'] = true;

    } else{
      header("location: ../login.php?errormsg=Invalid Username or Password");
    }   
  }

?>
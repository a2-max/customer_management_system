<?php
session_start();

  if(!isset($_SESSION['loggedin'])){
     header("location: login.php");
  }
  
include("db_connect.php");

if(isset($_POST['submit_btn'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, (int) $_POST['mobile']);
    $cuid = rand(1, 9000000);

    $query = "INSERT INTO `customers`(`cuid`, `name`, `address`, `email`, `mobile`)
              VALUES ($cuid,'$name','$address','$email','$mobile')";
    $run = mysqli_query($conn, $query);
    
    if($run){
        header("location: ../all-customer.php?successmsg=Customer Added Successfully");
    }else{
        header("location: ../all-customer.php?errormsg=Failed to add Customer");
    }
}


?>
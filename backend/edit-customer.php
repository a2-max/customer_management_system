<?php
session_start();

if(!isset($_SESSION['loggedin'])){
   header("location: login.php");
}

include("db_connect.php");
$cuid = $_GET['cuid'];

if(isset($_POST['submit_btn'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, (int) $_POST['mobile']);

    $query = "UPDATE `customers` SET `name`=
    '$name',`address`='$address',`email`='$email',`mobile`='$mobile' WHERE cuid = $cuid";
    $run = mysqli_query($conn, $query);
    
    if($run){
        header("location: ../customer-detail.php?cuid=$cuid&successmsg=Customer Added Successfully");
    }else{
        header("location: ../customer-detail.php?cuid=$cuid&errormsg=Failed to add Customer");
    }
}


?>
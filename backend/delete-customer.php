<?php
session_start();

if(!isset($_SESSION['loggedin'])){
   header("location: login.php");
}

include("db_connect.php");
$cuid = $_GET['cuid'];

$del_customer_detail = "DELETE FROM `customers` WHERE cuid = $cuid";
$del_purchase_items = "DELETE FROM `purchase_items` WHERE cuid = $cuid";
$query1 = mysqli_query($conn, $del_customer_detail);
$query2 = mysqli_query($conn, $del_purchase_items);

if($query1 && $query2){
    header("location: ../all-customer.php?successmsg=Customer Deleted Successfully");
}else{
    header("location: ../customer-detail.php?errormsg=Failed to Delete Customer");
}

?>
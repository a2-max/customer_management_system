<?php
session_start();

if(!isset($_SESSION['loggedin'])){
   header("location: login.php");
}

include("db_connect.php");
$id = $_GET['id'];
$cuid = $_GET['cuid'];

$sql = "DELETE FROM `purchase_items` WHERE id = $id";
$query = mysqli_query($conn, $sql);

if($query){
    header("location: ../customer-detail.php?cuid=$cuid&successmsg=Record Deleted Successfully");
}else{
    header("location: ../customer-detail.php?cuid=$cuid&errormsg=Failed to Delete Record");
}

?>
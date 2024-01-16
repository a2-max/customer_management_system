<?php
session_start();

if(!isset($_SESSION['loggedin'])){
   header("location: login.php");
}
include("db_connect.php");
$cuid = $_GET['cuid'];

if(isset($_POST['submit_btn'])){
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $install = mysqli_real_escape_string($conn, (float) $_POST['install_charge']);
    $service = mysqli_real_escape_string($conn, (float) $_POST['service_charge']);
    $recharge = mysqli_real_escape_string($conn, (float) $_POST['recharge']);
    $other1 = mysqli_real_escape_string($conn, $_POST['item1']);
    $other1_amount = mysqli_real_escape_string($conn, (float) $_POST['item1_amount']);
    $other2 = mysqli_real_escape_string($conn, $_POST['item2']);
    $other2_amount = mysqli_real_escape_string($conn, (float) $_POST['item2_amount']);
    $other3 = mysqli_real_escape_string($conn, $_POST['item3']);
    $other3_amount = mysqli_real_escape_string($conn, (float) $_POST['item3_amount']);
    $other4 = mysqli_real_escape_string($conn, $_POST['item4']);
    $other4_amount = mysqli_real_escape_string($conn, (float) $_POST['item4_amount']);    
    $paid = mysqli_real_escape_string($conn, (float) $_POST['paid_amount']);

    $totalExpenses = $install + $service + $recharge + $other1_amount + $other2_amount + $other3_amount + $other4_amount;
    $due = $totalExpenses - $paid;

    // Fetching Date and Time of Kathmandu
    date_default_timezone_set('Asia/kathmandu');
    $date_and_time = date("Y-m-d h:i:s");

    $sql = "INSERT INTO `purchase_items`(`cuid`, `date`, `install_charge`, `service_charge`, `recharge`,
            `item1_name`, `item1_amount`, `item2_name`, `item2_amount`, `item3_name`, `item3_amount`, `item4_name`,
            `item4_amount`, `total_exp`, `paid`, `due`, `datetime`) VALUES
            ($cuid, '$date', $install, $service, $recharge, '$other1', $other1_amount, '$other2', $other2_amount,
             '$other3', $other3_amount, '$other4', $other4_amount, $totalExpenses, $paid, $due, '$date_and_time')";
    $run = mysqli_query($conn, $sql);

    if($run){
        header("location: ../customer-detail.php?cuid=$cuid&successmsg=Record Added Successfully");
    }else{
        header("location: ../customer-detail.php?cuid=$cuid&errormsg=Failed to add Record");
    }
}



?>
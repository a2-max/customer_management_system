<?php
session_start();

if(!isset($_SESSION['loggedin'])){
   header("location: login.php");
}

include("db_connect.php");
$id = $_GET['id'];
$cuid = $_GET['cuid'];

if(isset($_POST['submit_btn'])){
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

    $sql = "UPDATE `purchase_items` SET
            `install_charge`=$install,`service_charge`=$service,`recharge`=$recharge,
            `item1_name`='$other1',`item1_amount`=$other1_amount,`item2_name`='$other2',
            `item2_amount`=$other2_amount,`item3_name`='$other3',`item3_amount`=$other3_amount,
            `item4_name`='$other4',`item4_amount`=$other4_amount,`total_exp`=$totalExpenses,
            `paid`=$paid,`due`=$due WHERE `id` = $id ";
    $runquery = mysqli_query($conn, $sql);

    if($runquery){
        header("location: ../customer-detail.php?cuid=$cuid&successmsg=Record Updated Successfully");
    }else{
        header("location: ../customer-detail.php?cuid=$cuid&errormsg=Failed to Update Record");
    }
}



?>
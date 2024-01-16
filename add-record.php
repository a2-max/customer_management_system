<?php
session_start();

include("backend/db_connect.php");
  if(!isset($_SESSION['loggedin'])){
     header("location: login.php");
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Add Record | Dudhauli Nishan Cable T.V Network</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/customer-detail.css">
    <link rel="stylesheet" href="css/forms.css">
    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <!-- message toast start -->
    <?php
    // if success message exist
    if(isset($_GET['successmsg'])){
        ?>
            <div class="msgtoast toastsuccess">
            <p> <?php echo $_GET['successmsg'] ?> </p>
            <i class="fas fa-times successtoastclose"></i>
            </div>
            <script>
                const stoast = document.querySelector('.toastsuccess');
                const scloseToast = document.querySelector('.successtoastclose');
                scloseToast.addEventListener('click', () => {
                    stoast.style.display = "none";
                });
            </script>
        <?php
    }

    // if error message exist
    if(isset($_GET['errormsg'])){
        ?>
            <div class="msgtoast toasterror">
                <p><?php echo $_GET['errormsg'] ?></p>
                <i class="fas fa-times errortoastclose"></i>
            </div>
            <script>
                const etoast = document.querySelector('.toasterror');
                const ecloseToast = document.querySelector('.errortoastclose');
                ecloseToast.addEventListener('click', () => {
                  etoast.style.display = "none";
                });
            </script>
        <?php
    }
    ?>
    <!-- message toast end -->
    <div class="sidebar">
        <div class="logo-details">
            <i class="fab fa-dyalog"></i>
            <span class="logo_name">Nishan Cable</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="index.php">
                    <i class="fas fa-th-large"></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="active">
                    <i class="fas fa-user"></i>
                    <span class="links_name">Add Customer</span>
                </a>
            </li>
            <li>
                <a href="all-customer.php">
                    <i class="fas fa-users-cog"></i>
                    <span class="links_name">All Customer</span>
                </a>
            </li>
            <li class="log_out">
                <a href="backend/logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class="fas fa-bars sidebarBtn"></i>
                <!-- <span class="dashboard">Customer Details</span> -->
            </div>
            <div class="search-box">
                <form action="search.php" method="POST">
                    <input type="search" id="search" name="searchinput" placeholder="Search...">
                    <button type="submit" name="search_btn"><i class='fas fa-search'></i></button>
                </form>
            </div>
        </nav>


        <?php
            $cuid = $_GET['cuid'];


        ?>
        <div class="home-content">
            <div class="sales-boxes">
                <?php
                if(isset($cuid)){  //When CUID is in URL

                    
            $sql1 = "SELECT * FROM `customers` WHERE `cuid`= $cuid";
            $query1 = mysqli_query($conn, $sql1);
            $result1 = mysqli_fetch_assoc($query1);
            $ispresent_cuid = mysqli_num_rows($query1);

            if($ispresent_cuid > 0){
                ?>
                    <div class="recent-sales box">
                    <div class="title">Add New Record</div>
                    <div class="customer-info">
                        <div class="info-row">
                            <p class="cuid">Name: <span><?php echo($result1['name']) ?></span></p>
                            <p class="address">CUID: <span><?php echo($result1['cuid']) ?></span></p>
                        </div>
                        <div class="info-row">
                            <!-- <p class="cuid">Total Expenses: <span id="expenses"></span></p>
                            <p class="address">Due: <span></span></p> -->
                        </div>
                        </div>
                    <div class="sales-details">
                        <!-- form -->
                        <form action="backend/add-record.php?cuid=<?php echo($result1['cuid']) ?>" method="post">
                            <div class="single-row">
                                <div class="input-area">
                                    <label>Installation Charge</label>
                                    <input type="number" oninput="inputfunc()" id="installCharge" placeholder="Enter Installation Charge" name="install_charge" autocomplete="off">
                                </div>
                                <div class="input-area">
                                    <label>Service Charge</label>
                                    <input type="number" oninput="inputfunc()" id="serviceCharge" placeholder="Enter Service Charge" name="service_charge">
                                </div>
                            </div>
                            <div class="single-row">
                                <div class="input-area">
                                    <label>Recharge Amount</label><input type="number" oninput="inputfunc()" id="recharge" placeholder="Recharge Amount" name="recharge" autocomplete="off">
                                </div>
                                <!-- <div class="input-area"> -->
                                <div class="other">
                                    <p>Other</p> <i class="fas fa-sort-down"></i>
                                </div>
                                <!-- </div> -->
                            </div>
                           <div class="other-item">
                           <div class="single-row">
                               <div class="item">
                                   <input type="text" placeholder="Item 1" name="item1">
                                   <input type="number" oninput="inputfunc()" id="other1" name="item1_amount" placeholder="Amount">
                               </div>
                               <div class="item">
                                   <input type="text" placeholder="Item 2" name="item2">
                                   <input type="number" oninput="inputfunc()" id="other2" name="item2_amount" placeholder="Amount">
                               </div>
                            </div>
                            <div class="single-row">
                               <div class="item">
                                   <input type="text" placeholder="Item 3" name="item3">
                                   <input type="number" oninput="inputfunc()" id="other3" name="item3_amount" placeholder="Amount">
                               </div>
                               <div class="item">
                                   <input type="text" placeholder="Item 4" name="item4">
                                   <input type="number" oninput="inputfunc()" id="other4" name="item4_amount" placeholder="Amount">
                               </div>
                            </div>
                           </div>
                           <div class="single-row">
                               <div class="input-area">
                                   <label>Date</label>
                                   <input type="date" name="date" required>
                               </div>
                               <div class="input-area">
                                   <label>Paid Amount</label>
                                   <input type="number" oninput="inputfunc()" id="paid_amount" placeholder="Paid Amount" name="paid_amount" autocomplete="off">
                               </div>
                            </div>
                            <button type="submit" name="submit_btn">Save</button>
                        </form>
                        <!-- form ends -->
                    </div>
                </div>
                    <?php


            }else{ //When CUID do not match
                echo("Invalid Customer ID!!");
            }
                }else{  //When CUID is not in the URL
                    echo("");
                }
                ?>
                
            </div>
        </div>
    </section>

    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function () {
            sidebar.classList.toggle("active");
        }
    </script>

    <!-- bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="js/add-record.js"></script>
</body>

</html>
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
    <title>Customer Detail | Dudhauli Nishan Cable T.V Network</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/customer-detail.css">
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
                <a href="add-customer.php">
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

            $sql2 = "SELECT * FROM `purchase_items` WHERE `cuid`= $cuid ORDER BY id DESC";
            $query2 = mysqli_query($conn, $sql2);
            $cu_count = mysqli_num_rows($query2);

            $duequery = "SELECT `due` FROM `purchase_items` WHERE `cuid`= $cuid";
            $duerun = mysqli_query($conn, $duequery);
            $dueres = mysqli_fetch_assoc($duerun);

                    if($ispresent_cuid > 0){
                        ?>
                        
                <div class="recent-sales box">
                    <div class="title">Info of <b><?php echo($result1['name']) ?></b></div>
                    <div class="customer-info">
                        <div class="info-row">
                            <p class="cuid">CUID: <span><?php echo($result1['cuid']) ?></span></p>
                            <p class="address">Address: <span><?php echo($result1['address']) ?></span></p>
                        </div>
                        <div class="info-row">
                            <p class="email">Email: <span><?php echo($result1['email']) ?></span></p>
                            <p class="mobile">Mobile: <span><?php echo($result1['mobile']) ?></span></p>
                        </div>
                        <div class="info-row">
                            <p class="cuid">Due Amount: <span><?php
                                if($cu_count > 0){
                                        $sum_due = "SELECT SUM(due) FROM `purchase_items` WHERE cuid = $cuid";
                                        $sum_query = mysqli_query($conn, $sum_due);
                                        $sum_result = mysqli_fetch_assoc($sum_query);
                                        print_r($sum_result["SUM(due)"]);
                                }else{
                                    echo("");
                                }
                             ?></span></p>
                        </div>
                    </div>
                    <div class="buttons">
                        <a href="edit-customer.php?cuid=<?php echo $cuid ?>" class="edit">Edit</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        Delete
                        </button>
                        <a href="add-record.php?cuid=<?php echo $cuid ?>" class="add-record">Add New Record</a>
                    </div>
                    <div class="sales-details">
                        <?php
                        while($result2 = mysqli_fetch_assoc($query2)){
                            ?>
                            <!-- bootstrap table -->

                        <div class="date-area">
                            <p><?php echo($result2['date']) ?></p>
                            <a href="edit-record.php?cuid=<?php echo $cuid ?>&id=<?php echo($result2['id']) ?>"><button class="edit-btn">Edit</button></a>
                            <button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleterecordModal">
                        Delete
                        </button>
                        <!-- Delete Record Modal -->
                        <div class="modal fade" id="deleterecordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                            </div>
                            <div class="modal-body">
                                Are you sure want to delete this record?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <a class="bootstrap-del-btn" href="backend/delete-record.php?id=<?php echo $result2['id']; ?>&cuid=<?php echo $cuid ?>"><button type="button" class="btn btn-danger">Delete</button></a>
                            </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        <table class="table  table-hover">
                            <thead class="heading">
                                <tr>
                                    <th scope="col">Transaction</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($result2['install_charge'] > 0){
                                    ?>
                                         <tr>
                                            <td>Installation Charge</td>
                                            <td><?php echo($result2['install_charge']) ?></td>
                                         </tr>
                                    <?php
                                }
                                ?>
                                <?php
                                if($result2['service_charge'] > 0){
                                    ?>
                                        <tr>
                                            <td>Service Charge</td>
                                            <td><?php echo($result2['service_charge']) ?></td>
                                        </tr>
                                    <?php
                                }
                                ?>
                                <?php
                                if($result2['recharge'] > 0){
                                    ?>
                                        <tr>
                                            <td>Recharge</td>
                                            <td><?php echo($result2['recharge']) ?></td>
                                        </tr>
                                    <?php
                                }
                                ?>
                                <?php
                                if($result2['item1_amount'] > 0){
                                    ?>
                                        <tr>
                                            <td><?php echo($result2['item1_name']) ?></td>
                                            <td><?php echo($result2['item1_amount']) ?></td>
                                        </tr>
                                    <?php
                                }
                                ?>
                                <!-- item 2 -->                                
                                <?php
                                if($result2['item2_amount'] > 0){
                                    ?>
                                        <tr>
                                            <td><?php echo($result2['item2_name']) ?></td>
                                            <td><?php echo($result2['item2_amount']) ?></td>
                                        </tr>
                                    <?php
                                }
                                ?>
                                <!-- item 3 -->
                                <?php
                                if($result2['item3_amount'] > 0){
                                    ?>
                                        <tr>
                                            <td><?php echo($result2['item3_name']) ?></td>
                                            <td><?php echo($result2['item3_amount']) ?></td>
                                        </tr>
                                    <?php
                                }
                                ?>
                                <!-- item 4 -->
                                <?php
                                if($result2['item4_amount'] > 0){
                                    ?>
                                        <tr>
                                            <td><?php echo($result2['item4_name']) ?></td>
                                            <td><?php echo($result2['item4_amount']) ?></td>
                                        </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <th scope="col">Paid: <span><?php echo($result2['paid']) ?></span></th>
                                    <th scope="col">Due: <span><?php echo($result2['due']) ?></span></th>
                                </tr>
                            </tbody>
                        </table>
                        <!-- bootstrap table ends -->
                            <?php
                        }
                        ?>
                    </div>
                    
                </div>
                        <?php
                    }else{
                        echo("Invalid Customer ID!!");
                    }
                }else{  //When CUID is not in URL
                    echo("");
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Delete Modal -->
 <!-- Button trigger modal -->

<!-- Delete Customer Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
        Are you sure want to delete customer?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="backend/delete-customer.php?cuid=<?php echo $cuid ?>"><button type="button" class="btn btn-danger">Delete</button></a>
      </div>
    </div>
  </div>
</div>

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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
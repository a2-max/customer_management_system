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
    <title>Admin Dashboard | Dudhauli Nishan Cable T.V Network</title>
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
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class="fab fa-dyalog"></i>
            <span class="logo_name">Nishan Cable</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="#" class="active">
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
                <span class="dashboard">Dashboard</span>
            </div>
            <div class="search-box">
                <form action="search.php" method="POST">
                    <input type="search" id="search" name="searchinput" placeholder="Search...">
                    <button type="submit" name="search_btn"><i class='fas fa-search'></i></button>
                </form>
            </div>
        </nav>

        <?php
        //  =========================  Queries for showing result in top Cards =========================
        // Total Customers
        $select = "SELECT * FROM `customers`";
        $sel_query = mysqli_query($conn, $select);
        $cu_count = mysqli_num_rows($sel_query);

        // Total Due
        $sum_due = "SELECT SUM(due) FROM `purchase_items`";
        $sum_query = mysqli_query($conn, $sum_due);
        $sum_result = mysqli_fetch_assoc($sum_query);

        // Fetching Last 12 hours Data
        date_default_timezone_set('Asia/kathmandu');
        $date_and_time = date("Y-m-d");

        // Today Total Sales
        $today_income = "select SUM(total_exp) from `purchase_items` where date(datetime) = '$date_and_time'";
        $today_income_query = mysqli_query($conn, $today_income);
        $today_income_result = mysqli_fetch_assoc($today_income_query);

        // Today Due Sales
        $today_due = "select SUM(due) from `purchase_items` where date(datetime) = '$date_and_time'";
        $today_due_query = mysqli_query($conn, $today_due);
        $today_due_result = mysqli_fetch_assoc($today_due_query);

        ?>
        <div class="home-content">
            <div class="overview-boxes">
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Customers</div>
                        <div class="number"><?php echo $cu_count ?></div>
                        <!-- <div class="indicator">
                            <i class="fas fa-arrow-up"></i>
                            <span class="text">Up from yesterday</span>
                        </div> -->
                    </div>
                    <i class="fas fa-users cart"></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Due</div>
                        <div class="number"><?php print_r($sum_result["SUM(due)"]); ?></div>
                        <!-- <div class="indicator">
                            <i class="fas fa-arrow-up"></i>
                            <span class="text">Up from yesterday</span>
                        </div> -->
                    </div>
                    <i class="fas fa-hand-holding-usd cart four"></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Sales Today</div>
                        <div class="number"><?php print_r($today_income_result["SUM(total_exp)"]) ?></div>
                        <!-- <div class="indicator">
                            <i class="fas fa-arrow-up"></i>
                            <span class="text">Up from yesterday</span>
                        </div> -->
                    </div>
                    <i class="fas fa-cart-plus cart three"></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Due Today</div>
                        <div class="number"><?php print_r($today_due_result["SUM(due)"]) ?></div>
                        <!-- <div class="indicator">
                            <i class="fas fa-arrow-down"></i>
                            <span class="text">Down From Today</span>
                        </div> -->
                    </div>
                    <i class="fas fa-cart-arrow-down cart four"></i>
                </div>
            </div>

            <div class="sales-boxes">
                <div class="recent-sales box">
                    <div class="title">Recent Customers</div>
                    <div class="sales-details">
                        <!-- bootstrap table -->

                        <?php
                        $sql = "SELECT * FROM `customers` ORDER BY id DESC LIMIT 10";
                        $query = mysqli_query($conn, $sql);
                        $i = 1;

                        ?>
                        <table class="table table-striped table-hover">
                            <thead class="heading">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Cuid</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col" style="text-align: center;">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while($result = mysqli_fetch_assoc($query)){
                                    ?>
                                      <tr>
                                        <th scope="row"><?php echo $i++ ?></th>
                                        <td><?php echo $result['cuid']; ?></td>
                                        <td><?php echo $result['name'] ?></td>
                                        <td><?php echo $result['address'] ?></td>
                                        <td><?php echo $result['email'] ?></td>
                                        <td><?php echo $result['mobile'] ?></td>
                                        <td style="text-align: center;"><a href="customer-detail.php?cuid=<?php echo $result['cuid'] ?>"><i class="far fa-eye"></i></a></td>
                                      </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- bootstrap table ends -->
                    </div>
                    <div class="button">
                        <a href="all-customer.php">See All</a>
                    </div>
                </div>
                <!-- <div class="top-sales box">
                    <div class="title">Top Seling Product</div>
                    <ul class="top-sales-details">
                        <li>
                            <a href="#">
                                <img src="images/bag.jpg" alt="">
                                <span class="product">Vuitton Sunglasses</span>
                            </a>
                            <span class="price">$1107</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/bag.jpg" alt="">
                                <span class="product">Hourglass Jeans </span>
                            </a>
                            <span class="price">$1567</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/bag.jpg" alt="">
                                <span class="product">Nike Sport Shoe</span>
                            </a>
                            <span class="price">$1234</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/bag.jpg" alt="">
                                <span class="product">Hermes Silk Scarves.</span>
                            </a>
                            <span class="price">$2312</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/bag.jpg" alt="">
                                <span class="product">Succi Ladies Bag</span>
                            </a>
                            <span class="price">$1456</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/bag.jpg" alt="">
                                <span class="product">Gucci Womens's Bags</span>
                            </a>
                            <span class="price">$2345</span>
                        <li>
                            <a href="#">
                                <img src="images/bag.jpg" alt="">
                                <span class="product">Addidas Running Shoe</span>
                            </a>
                            <span class="price">$2345</span>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/bag.jpg" alt="">
                                <span class="product">Bilack Wear's Shirt</span>
                            </a>
                            <span class="price">$1245</span>
                        </li>
                    </ul>
                </div> -->
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
</body>

</html>
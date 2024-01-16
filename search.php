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
    <title>Search Customer | Dudhauli Nishan Cable T.V Network</title>
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

        <div class="home-content">
            <div class="sales-boxes">
                <div class="recent-sales box">
                    <div class="title">Search Results</div>
                    <div class="sales-details">
                        <!-- bootstrap table -->

                        <?php
                          if(isset($_POST['search_btn'])){
                            $search_input = mysqli_real_escape_string($conn, $_POST['searchinput']);

                            $search_sql = "SELECT * FROM `customers` WHERE `name` LIKE '%{$search_input}%' 
                                                                        OR `cuid` LIKE '%{$search_input}%' 
                                                                        OR `mobile` LIKE '%{$search_input}%' 
                                                                        OR `email` LIKE '%{$search_input}%'
                                                                        OR `address` LIKE '%{$search_input}%'";
                            $search_query = mysqli_query($conn, $search_sql);
                            $search_count = mysqli_num_rows($search_query);
                            $i = 1;

                            ?>
                                <?php
                                if($search_count > 0){
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
                                    while($result = mysqli_fetch_assoc($search_query)){
                                        ?>
                                          <tr>
                                            <th scope="row"><?php echo $i++ ?></th>
                                            <td><?php echo $result['cuid']; ?></td>
                                            <td><?php echo $result['name'] ?></td>
                                            <td><?php echo $result['address'] ?></td>
                                            <td><?php echo $result['email'] ?></td>
                                            <td><?php echo $result['mobile'] ?></td>
                                            <td style="text-align: center;"><a href="customer-detail.php?cuid=<?php echo $result['cuid']; ?>"><i class="far fa-eye"></i></a></td>
                                          </tr>
                                        <?php
                                    }
                                    ?>                                    
                            </tbody>
                        </table>
                        <?php
                                }else{
                                    echo("<p>No Result Found...</p>");
                                }
                          }
                        ?>
                        <!-- bootstrap table ends -->
                    </div>
                    <div id="result-table"></div>
                </div>
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
    <!-- J Query CDN -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
        crossorigin="anonymous"></script>
</body>

</html>
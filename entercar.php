<!DOCTYPE html>
<html>
<?php include('session_client.php'); ?> 

<head>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">Car Rentals </a>
            </div>

            <?php
            if (isset($_SESSION['login_client'])) {
            ?> 
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_client']; ?></a>
                    </li>
                    <li>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <span class="glyphicon glyphicon-user"></span> Control Panel <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="entercar.php">Add Car</a></li>
                                    <li><a href="enteroffice.php"> Add Office</a></li>
                                    <li><a href="clientview.php">View</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>
            
            <?php
            } else if (isset($_SESSION['login_customer'])) {
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <li>
                        <a href="#">History</a>
                    </li>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>

            <?php
            } else {
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="clientlogin.php">Employee</a>
                    </li>
                    <li>
                        <a href="customerlogin.php">Customer</a>
                    </li>
                    <li>
                        <a href="#"> FAQ </a>
                    </li>
                </ul>
            </div>
            <?php
            }
            ?>
        </div>
    </nav>

    <div class="container" style="margin-top: 65px;">
        <div class="col-md-7" style="float: none; margin: 0 auto;">
            <div class="form-area">
                <form role="form" action="entercar1.php" enctype="multipart/form-data" method="POST">
                    <br style="clear: both">
                    <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Please Provide Your Car Details. </h3>

                    <div class="form-group">
            <input type="text" class="form-control" id="car_model" name="car_model" placeholder="Car Model " required autofocus="">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="car_nameplate" name="car_nameplate" placeholder="Vehicle Name Plate" required>
          </div>     

          <div class="form-group">
            <input type="text" class="form-control" id="car_year" name="car_year" placeholder="Car Year" required>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="price" name="price" placeholder="Price per day (EGP)" required>
          </div>

          <div class="form-group">
            <input name="uploadedimage" type="file">
          </div>

                    <button type="submit" id="submit" name="submit" class="btn btn-success pull-right"> Add Car</button>
                </form>
            </div>
        </div>

        <div class="col-md-12" style="float: none; margin: 0 auto;">
            <div class="form-area" style="padding: 0px 100px 100px 100px;">
                <form action="" method="POST">
                    <br style="clear: both">
                    <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Cars Available on a Specific Day </h3>
                    <label for="specific_day">Select a Day:</label>
                    <input type="date" name="specific_day" required>
                    <button type="submit" class="btn btn-success">View Cars</button>
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $specific_day = $_POST['specific_day'];
                    $user_check = $_SESSION['login_client'];

                    $sql = "SELECT car_model , c.car_nameplate , car_year , price , car_availability
                    FROM cars c
                    LEFT JOIN reservation r ON c.car_nameplate = r.car_nameplate
                    WHERE ('$specific_day' NOT BETWEEN DATE(`start-date`) AND DATE(`end-date`)
                    OR `start-date` IS NULL OR `end-date` IS NULL)
                    AND c.car_availability = 'active'; ";
                    
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                ?>
                        <div style="overflow-x:auto;">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th></th>
                                        <th width="40%">Model</th>
                                        <th width="30%">Name plate</th>
                                        <th width="13%">Year</th>
                                        <th width="17%">Price per day</th>
                                        <th width="1%">Status</th>
                                    </tr>
                                </thead>

                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tbody>
                                        <tr>
                                            <td><span class="glyphicon glyphicon-menu-right"></span></td>
                                            <td><?php echo $row["car_model"]; ?></td>
                                            <td><?php echo $row["car_nameplate"]; ?></td>
                                            <td><?php echo $row["car_year"]; ?></td>
                                            <td><?php echo $row["price"]; ?></td>
                                            <td><?php echo $row["car_availability"]; ?></td>
                                        </tr>
                                    </tbody>
                                <?php } ?>
                            </table>
                        </div>
                        <br>
                <?php
                    } else {
                        echo '<h4><center>No cars available on the specified day</center></h4>';
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h5>© <?php echo date("Y"); ?> Car Rentals</h5>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>

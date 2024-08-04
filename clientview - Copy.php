<!DOCTYPE html>
<html>
<?php 
session_start();
require 'connection.php';
$conn = Connect();
?>
<head>
<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
<link rel="stylesheet" href="assets/w3css/w3.css">
<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>




<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
                </button>
            <a class="navbar-brand page-scroll" href="index.php">
               Car Rentals </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->

        <?php
            if(isset($_SESSION['login_client'])){
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
        <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Control Panel <span class="caret"></span> </a>
            <ul class="dropdown-menu">
          <li> <a href="entercar.php">Add Car</a></li>
          <li> <a href="enteroffice.php"> Add Office</a></li>
          <li> <a href="clientview.php">View</a></li>

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
            }
            else if (isset($_SESSION['login_customer'])){
        ?>
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_customer']; ?></a>
                </li>
                <ul class="nav navbar-nav">
        <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Garagge <span class="caret"></span> </a>
            <ul class="dropdown-menu">
          <li> <a href="prereturncar.php">Return Now</a></li>
          <li> <a href="mybookings.php"> My Bookings</a></li>
        </ul>
        </li>
      </ul>
                <li>
                    <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                </li>
            </ul>
        </div>

        <?php
        }
            else {
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
                    <a href="faq/index.php"> FAQ </a>
                </li>
            </ul>
        </div>
            <?php   }
            ?>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<div class="bgimg-1">
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading" style="color: black">Car Rentals</h1>
                        <p class="intro-text">
                            Online Car Rental Service
                        </p>
                        <a href="#sec2" class="btn btn-circle page-scroll blink">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>

    

    <div class="container">
        <form method="post" action="view_reservations.php">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" required>

            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" required>

            <button type="submit">View Reservations</button>
        </form>
    </div>

    <?php
    if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        $login_client = $_SESSION['login_client'];

        $sql = "SELECT  reservation.res_id, customers.customer_name, customers.customer_phone, cars.car_model, cars.car_nameplate, `start-date`, `end-date`, `no. of days`, reservation.total_payment
        FROM `reservation` 
        NATURAL JOIN `cars`
        NATURAL JOIN `customers`
        WHERE `start-date` BETWEEN '$start_date' AND '$end_date'";

        $result = $conn->query($sql);

        if (mysqli_num_rows($result) > 0) {
            // Display reservations within the specified period
            echo '<div class="container">
                    <div class="jumbotron">
                        <h1 class="text-center">Reservations within the specified period</h1>
                    </div>
                </div>';

            echo '<div class="table-responsive" style="padding-left: 100px; padding-right: 100px;" >
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th width="5%">id</th>
                                <th width="15%">Name</th>
                                <th width="15%">Phone</th>
                                <th width="15%">Model</th>
                                <th width="15%">Name Plate</th>
                                <th width="15%">Start</th>
                                <th width="15%">End</th>
                                <th width="5%">Days</th>
                                <th width="10%">Payment</th>
                            </tr>
                        </thead>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                        <td>' . $row["res_id"] . '</td>
                        <td>' . $row["customer_name"] . '</td>
                        <td>' . $row["Customer_phone"] . '</td>
                        <td>' . $row["car_model"] . '</td>
                        <td>' . $row["car_nameplate"] . '</td>
                        <td>' . $row["start-date"] . '</td>
                        <td>' . $row["end-date"] . '</td>
                        <td>' . $row["no. of days"] . '</td>
                        <td>EGP. ' . $row["total_payment"] . '</td>
                    </tr>';
            }

            echo '</table></div>';
        } else {
            // Display a message if no reservations found in the specified period
            echo '<div class="container">
                    <div class="jumbotron">
                        <h1>No reservations found within the specified period</h1>
                    </div>
                </div>';
        }
    } else {
        // Handle case when form is not submitted
        echo '<div class="container">
                <div class="jumbotron">
                    <h1>Please select start and end dates to view reservations</h1>
                </div>
            </div>';
    }
    ?>

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

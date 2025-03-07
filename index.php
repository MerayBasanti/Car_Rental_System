<!DOCTYPE html>
<html>
<?php 
session_start(); 
require 'connection.php';
$conn = Connect();
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rentals</title>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
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

    <!-- Search Form -->
    <div class="container">
    <form method="get" action="index.php" class="form-inline">
        <div class="form-group">
            <label for="model">Model:</label>
            <select class="form-control" name="model">
                <option value="">Select Model</option>
                <?php
                $sqlmodel = "SELECT DISTINCT car_model
                FROM `cars` 
                WHERE car_availability ='active'";
                $resultmodel  = mysqli_query($conn, $sqlmodel);

                $models = [];
                while ($row = mysqli_fetch_assoc($resultmodel)) {
                    $models[] = $row['car_model'];
                }
                foreach ($models as $model) {
                    echo "<option value='$model'>$model</option>";
                }

                
                ?>

            </select>
        </div>

        <div class="form-group">
            <label for="year">Year:</label>
            <select class="form-control" name="year">
                <option value="">Select Year</option>
                <?php
                $sqlyear = "SELECT DISTINCT car_year
                FROM `cars` 
                WHERE car_availability ='active'";
                $resultyear  = mysqli_query($conn, $sqlyear);

                $years = [];
                while ($row = mysqli_fetch_assoc($resultyear)) {
                    $years[] = $row['car_year'];
                }
                foreach ($years as $year) {
                    echo "<option value='$year'>$year</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <select class="form-control" name="price">
                <option value="">Select Price Range</option>
                <?php
                $priceRanges = ["0-100", "101-200", "201-300"]; // Replace with actual price range data
                foreach ($priceRanges as $range) {
                    echo "<option value='$range'>$range</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>


    <div id="sec2" style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">
        <h3 style="text-align:center;">Available Cars</h3>
<br>
        <section class="menu-content">
            <?php   

            if (isset($_GET['model']) || isset($_GET['year']) || isset($_GET['price'])) {
                // If any search criteria is provided, build a dynamic SQL query
                $sqlSearch = "SELECT * FROM cars WHERE car_availability = 'Active'";

                if (!empty($_GET['model'])) {
                    $model = mysqli_real_escape_string($conn, $_GET['model']);
                    $sqlSearch .= " AND car_model LIKE '%$model%'";
                }

                if (!empty($_GET['year'])) {
                    $year = mysqli_real_escape_string($conn, $_GET['year']);
                    $sqlSearch .= " AND car_year = '$year'";
                }

                if (!empty($_GET['price'])) {
                    $price = mysqli_real_escape_string($conn, $_GET['price']);
                    $sqlSearch .= " AND price <= '$price'";
                }

                $result1 = mysqli_query($conn, $sqlSearch);
            } else {
                // If no search criteria, fetch all available cars
                $sql1 = "SELECT * FROM cars WHERE car_availability = 'Active'";
                $result1 = mysqli_query($conn, $sql1);
            }
            if(mysqli_num_rows($result1) > 0) {
                while($row1 = mysqli_fetch_assoc($result1)){
                    $car_nameplate = $row1["car_nameplate"];
                    $car_model = $row1["car_model"];
                    $car_year = $row1["car_year"];
                    $price = $row1["price"];
                    $car_img = $row1["car_img"];
               
                    ?>
            <a href="booking.php?nameplate=<?php echo($car_nameplate) ?>">
            <div class="sub-menu">
            

            <img class="card-img-top" src="<?php echo $car_img; ?>" alt="Card image cap">
            <h5><b> <?php echo $car_model; ?> </b></h5>
            <h7> Price : <?php echo ("EGP." . $price . "/day"); ?></h7>
            <h6> Year : <?php echo ($car_year); ?></h6>

            
            </div> 
            </a>
            <?php }}
            else {
                ?>
<h1> No cars available :( </h1>
                <?php
            }
            ?>                                   
        </section>
                    
    </div>

    <div class="bgimg-2">
        <div class="caption">
            <span class="border" style="background-color:transparent;font-size:25px;color: #f7f7f7;"></span>
        </div>
    </div>

    
    <!-- Container (Contact Section) -->
    <!-- -->
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
    <script>
        function myMap() {
            myCenter = new google.maps.LatLng(25.614744, 85.128489);
            var mapOptions = {
                center: myCenter,
                zoom: 12,
                scrollwheel: true,
                draggable: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);

            var marker = new google.maps.Marker({
                position: myCenter,
            });
            marker.setMap(map);
        }
    </script>
    <script>
        function sendGaEvent(category, action, label) {
            ga('send', {
                hitType: 'event',
                eventCategory: category,
                eventAction: action,
                eventLabel: label
            });
        };
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCuoe93lQkgRaC7FB8fMOr_g1dmMRwKng&callback=myMap" type="text/javascript"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="assets/js/jquery.easing.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="assets/js/theme.js"></script>
</body>

</html>

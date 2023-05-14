<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>RFG ELITE | Home</title>
    <script src="https://kit.fontawesome.com/a1366662c0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="homepage1.css" media="screen">

</head>

<body class="u-body u-xl-mode" data-lang="en">

    <section class="Anton Antonio C1C1C1 D9D9D9 EFF Ellipse FFFFFF Lato Rectangle absolute admin align-items background border border-box border-radius box box-shadow box-sizing calc50 center color copyright display enter-email flex font-family font-size font-style font-weight height identical left line-height normal password position px px2 rfg rgba0 rgba70 show-pass sign-in solid text-align to top u-clearfix width u-section-1" id="sec-d0e7">
        <nav>
            <div class="left-nav">
                <img class="logo-img" src="images/logo-modified.png" alt="" data-image-width="362" data-image-height="362">
                <p> RFG ELITE</p>
            </div>
            <div class="right-icon">
              
                <span class="icon" id="user-icon">
                    <i class="fa-solid fa-user" style="color: #000000;"></i>
                </span>
                <div class="dropdown-menu" id="user-dropdown">
                    <ul>
                        <li><a class="list-item" href="Profile1.php">View &nbsp;Profile</a></li>
                        <li><a class="list-item" href="addAcc.php">Add &nbsp;Account</a></li>
                        <li><a class="list-item" onclick="return confirm('Are you sure to logout?');" href="logout.php">
                                Logout</a></li>
                    </ul>
                </div>
            </div>

        </nav>

        <div class="container">
            <div class="container-child">
            <?php
                // start the session
                session_start();

                // include the database connection code
                require('../connection.php');
                if (!isset($_SESSION['admin'])) {
                    // redirect to login page or show an error message
                    header("Location: log_index.php");
                    exit;
                }
                
                // get the logged-in adminID from the session
                $adminID = $_SESSION['admin'];

                // select the category and fullname of the logged-in user from the database
                $sql = "SELECT category, fullname FROM admin WHERE id = '$adminID'";
                $result = mysqli_query($conn, $sql);

                // check if the query was successful
                if (mysqli_num_rows($result) > 0) {
                    // fetch the category and fullname from the result set
                    $row = mysqli_fetch_assoc($result);
                    $category = $row['category'];
                    $fullname = $row['fullname'];
                } else {
                    $category = '';
                    $fullname = '';
                }
            ?>
            <h2>
                WELCOME TO ADMIN CONSOLE,
            </h2>
            <p class="adminrod">
                <?php echo $category . ' ' . $fullname; ?>!
            </p>

                <div class="box-card">



                    <div class="boxes">
                        <div>

                            <a href="http://localhost/SIA/Admin/Dashboard/Appointment-Dashboard.php">
                                <img src="images/dashboard.png" alt="">
                                <p class="dash">
                                    DASHBOARD
                                </p>
                            </a>
                        </div>
                    </div>

                    <div class="boxes">
                        <div>

                            <a href="http://localhost/SIA/Admin/Inventory/Admin/index.php">
                                <img src="images/image5.png" alt="" data-image-width="400" data-image-height="400" href="http://localhost/SIA/Admin/Inventory/Admin/index.php">
                                <p class="dash">
                                    INVENTORY
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="boxes">
                        <div>

                            <a href="http://localhost/SIA/Admin/GYM/GYM/services.php">
                                <img src="images/image6.png" alt="" data-image-width="400" data-image-height="400" href="http://localhost/SIA/Admin/GYM/GYM/services.php">
                                <p class="dash">
                                    APPOINTMENT
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="boxes">

                        <a href="http://localhost/SIA/Admin/GYM/GYM/Products.php#">
                            <img class="u-image u-image-contain u-image-default u-preserve-proportions u-image-3" src="images/image7.png" alt="" data-image-width="400" data-image-height="400" href="http://localhost/SIA/Admin/GYM/GYM/Products.php#">
                            <p class="dash">
                                E-COMMERCE
                            </p>
                        </a>
                    </div>

                </div>
            </div>

        </div>

       <div class="footer">
            <p>
                Delantar, Leonard A.</br>
                Elona, John Andrey U.</br>
                <p>
                    <p>
                    Encabo. James Earl L.</br>
                    Estanislao, John Paul L.</br>
                    </p>
                        <p>
                        Espiritu, Daniella E.</br>
                        Mendoza, Larby Jace S.</br>
                        </p>
                            <p>
                            Nacion, Arlene Joy E.</br>
                            Pausanos, Reymar C.</br>
                            </p>
                                <p>
                                Rañola, Troy D.</br>
                                Sandique, Ruben Jr. A.</br>
                                </p>
                                    <p>
                                    Santiago, Christian P.</br>
                                    Takase, Kojie L.</br>
                                    <p>
       </div>
       <div class="crdts">© Copyright 2023, SBIT-3F Group 3 | All Rights Re served.</div>


    </section>
    <script>
        var icon = document.getElementById("user-icon");
        var dropdown = document.getElementById("user-dropdown");

        icon.addEventListener("click", function(event) {
            dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
        });

        document.addEventListener("click", function(event) {
            if (!icon.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.style.display = "none";
            }
        });
    </script>
</body>

</html>
<?php
session_start();
require_once '../connection.php';

// Check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['admin'])) {
    header('location: login.php');
    exit();
}

// Fetch admin data from database
$adminID = substr($_SESSION['admin'], 0, 50);

$stmt = $conn->prepare("SELECT * FROM admin WHERE id = ?");
if (!$stmt) {
    exit('Error: ' . $conn->error); // handle prepare error
}

$stmt->bind_param("s", $adminID);
$stmt->execute();
$result = $stmt->get_result();
if (!$result) {
    exit('Error: ' . $stmt->error); // handle execute error
}

$row = $result->fetch_assoc();
if (!$row) {
    exit('Error: Admin record not found');// handle no results found
}


?>



<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>RFG ELITE | Profile</title>
    <link rel="stylesheet" href="Profile4.css" media="screen">
    <script src="https://kit.fontawesome.com/a1366662c0.js" crossorigin="anonymous"></script>
</head>

<body class="u-body u-xl-mode" data-lang="en">
    <section class="Anton Antonio C1C1C1 D9D9D9 EFF Ellipse FFFFFF Lato Rectangle absolute admin align-items background border border-box border-radius box box-shadow box-sizing calc50 center color copyright display enter-email flex font-family font-size font-style font-weight height identical left line-height normal password position px px2 rfg rgba0 rgba70 show-pass sign-in solid text-align to top u-clearfix width u-section-1" id="sec-65a1">
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
                        <li><a class="list-item" href="addAcc.php">Add&nbsp;Account</a></li>
                        <li><a class="list-item" onclick="return confirm('Are you sure to logout?');" href="logout.php">
                                Logout</a></li>
                    </ul>
                </div>
            </div>

        </nav>

        <div class="pcon"></div>
        <div class="pcon1"></div>

        <div class="container">
            <div class="container-box">
                <form class="edit ">
                    <div class="left-side">
                        <div class="admin-profile">
                            <h4>ADMIN PROFILE</h4>
                        </div>
                        <div class="adminprof">
                            <div class="image-preview">
							<img id="mypreview"  alt="Preview Image" src="data:image/jpeg;base64,<?php echo $row['photo']; ?>" style="width: 200px; height: 170px;"> </div>
						
                            <div class="userid-box">
                                <h1 class="adID">ADMIN ID:</h1>
                                <h2 class="adIDe"><?php echo $row['adminID']; ?></h2>
                            </div>
                            <button style="display: inline-block; margin-right: 10px;">
                            <a href="editProfile1.php?editid=<?php echo $adminID; ?>">EDIT</a>
                            </button>
                            <button class="cancel" style="display: inline-block; transform: translateY(-38px) translateX(60px);">
                            <a href="homepage.php">BACK</a>
                            </button>

                    </div>
                    </div>
                        
                    <div class="right-side">
                        <div class="admin-header">
                            <h4>ADMIN INFORMATION</h4>
                        </div>
                        <div class="admininfo">
                            <div class="name">
                                <h3 class="fname">Name: </h3>
                                <div class="fullname"><?php echo $row['fullname']; ?></div>
                            </div>
                            <div class="position">
                                <!--php echo $edit['fullname'];-->
                                <h3 class="pos">Position:</h3>
                                <div class="category"><?php echo $row['category']; ?></div>
                            </div>
                            <div class="status">
                                <!--php echo $edit['category']; -->
                                <h3 class="stat">Status:</h3>
                                <div class="status"><?php echo $row['status']; ?></div>
                            </div>
                            <!--php echo $edit['status']; -->
                            <div class="contact">
                                <h3 class="con">Contact&nbsp;Number: </h3>
                                <div class="contactnum"><?php echo $row['contactnum']; ?></div>
                            </div>
                            <!--php echo $edit['contactnum']; -->
                            <div class="address">
                                <h3 class="em">Email&nbsp;Address: </h3>
                                <div class="email"><?php echo $row['email']; ?></div>
                            </div>
                            <!--php echo $edit['email']; -->
                        <!--php echo $edit['password']; -->


                    </div>
                </form>
            </div>
        </div>
        </div>

        <script>
            // Change the type of input to password or text
            function Toggle() {
                var temp = document.getElementById("a-2056");
                if (temp.type === "password") {
                    temp.type = "text";
                } else {
                    temp.type = "password";
                }
            }


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
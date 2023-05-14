<?php
require('../connection.php');

if (isset($_GET['editid'])) {
    $id = $_GET['editid'];
    $sql = "SELECT * FROM admin WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $adminID = $row['adminID'];
    $fullname = $row['fullname'];
    $category = $row['category'];
    $status = $row['status'];
    $contactnum = $row['contactnum'];
    $email = $row['email'];
    $password = $row['password'];
}
// Handle the new image upload
if (isset($_FILES['newmyImage'])) {
    $newImage = $_FILES['newmyImage'];
    if ($newImage['error'] == UPLOAD_ERR_OK) {
        $imageData = file_get_contents($newImage['tmp_name']);
        $base64Image = base64_encode($imageData);

        // Update the photo in the database
        $sql = "UPDATE admin SET photo = '$base64Image' WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die(mysqli_error($conn));
        }
    }
}

if (isset($_POST['edit'])) {
    $adminID = $_POST['adminID'];
    $fullname = $_POST['fullname'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    $contactnum = $_POST['contactnum'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "UPDATE admin SET adminID = '$adminID', fullname = '$fullname', category = '$category', status = '$status', contactnum = '$contactnum', email = '$email', password = '$password' WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $sql = "SELECT * FROM admin WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $adminID = $row['adminID'];
        $fullname = $row['fullname'];
        $category = $row['category'];
        $status = $row['status'];
        $contactnum = $row['contactnum'];
        $email = $row['email'];
        $password = $row['password'];
    } else {
        die(mysqli_error($conn));
    }
}
?>



<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>RFG ELITE | Edit Profile</title>
    <link rel="stylesheet" href="editprofile2.css" media="screen">
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
                      <li><a class="list-item" href="addAcc.php">Add &nbsp;Account</a></li>
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
                <form class="edit" method="POST" action="editProfile1.php?editid=<?php echo $id ?>" enctype="multipart/form-data">
                <div class="right-side">
                        <div class="admin-header">
                            <h3>ADMIN INFORMATION</h3>
                        </div>
                        <div class="admininfo">
                            <div class="userid-box">
                                <h1 class="adID">ADMIN ID:</h1>
                                <input type="text" name="adminID" value="<?php echo $adminID ?? '' ?>">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                            </div>
                            <div class="name">
                                <h3 class="fname">Name: </h3>
                                <input type="text" name="fullname" value="<?php echo $fullname ?? '' ?>">
                            </div>
                            <div class="position">
                                <h3 class="pos">Position:</h3>
                                <input type="text" name="category" value="<?php echo $category ?? '' ?>">
                            </div>
                            <div class="status">
                                <h3 class="stat">Status:</h3>
                                <input type="text" name="status" value="<?php echo $status ?? '' ?>">
                            </div>
                            <div class="contact">
                                <h3 class="con">Contact&nbsp;Number: </h3>
                                <input type="text" name="contactnum" value="<?php echo $contactnum ?? '' ?>">
                            </div>
                            <div class="address">
                                <h3 class="em">Email&nbsp;Address: </h3>
                                <input type="text" name="email" value="<?php echo $email ?? '' ?>">
                            </div>
                            <div class="password">

                                <h3 class="pas">Password: </h3>
                                <input type="password" id="password-input" name="password" value="<?php echo $password ?? '' ?>">



                            </div>
                            <div class="checkbox"><input type="checkbox" onclick="Toggle()"><span>Show Password</span></input></div>

                        </div>
                    </div>
                    <div class="left-side">
                        <div class="admin-profile">
                            <h4>ADMIN PROFILE</h4>
                        </div>
                        <div class="adminprof">


                            <img id="mypreview" alt="Preview Image" src="data:image/jpeg;base64,<?php echo $row['photo']; ?>" style="width: 100%; height: 240px;">
                      
                        <input class="file-upload" type="file" name="newmyImage" id="newmyImage" accept="image/*" onchange="previewImage(event)">




                        <button type="submit" name="edit" class="savebtn" onclick="submitForm()">SAVE CHANGES</button>
                        <div class="cancel"><button><a href="Profile1.php">CANCEL</a></button>
</div>
                    </div>
    
                    </div>
                    </div>
            </div>
        </div>
        </form>
      
        <script>
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('mypreview');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            }

            // Change the type of input to password or text
            function Toggle() {
                var temp = document.getElementById("password-input");
                if (temp.type === "password") {
                    temp.type = "text";
                } else {
                    temp.type = "password";
                }
            }

            function submitForm() {
                var passwordInput = document.getElementById("password-input");
                if (passwordInput.value !== "") {
                    passwordInput.value = document.getElementById("a-2056").value;
                    document.forms[0].submit();
                }
            }
        </script>

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
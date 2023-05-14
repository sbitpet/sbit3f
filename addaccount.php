<?php
require('../connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prepare and bind parameters
    $stmt = mysqli_prepare($conn, "INSERT INTO admin (adminID, password, fullname, category, photo, created_on, status, contactnum, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssssssss", $adminID, $password, $fullname, $category, $photo, $created_on, $status, $contactnum, $email);

    // Set parameters
    $adminID = trim($_POST['adminID']);
    $password = trim($_POST['password']); // Hash password for security
    $fullname = trim($_POST['fullname']);
    $category = trim($_POST['category']);
    $created_on = date('Y-m-d');
    $status = 'Active';
    $contactnum = trim($_POST['contactnum']);
    $email = trim($_POST['email']);

    // Check if an image file was uploaded
    if (isset($_FILES['myImage']) && $_FILES['myImage']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['myImage']['tmp_name'];
        $photo = base64_encode(file_get_contents($tmpName));

        // Execute statement
        if (mysqli_stmt_execute($stmt)) {
            // Display success message
            echo "<script type='text/javascript'>alert('Register Successfully!');
                    window.location='homepage.php';
                </script>";
            exit;
        } else {
            // Display error message
            $error = 'Error: ' . mysqli_error($conn);
        }
    } else {
        // Display error message if no image file was uploaded
        $error = 'Please select an image file.';
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Account</title>
	<link rel="stylesheet" type="text/css" href="addaccount.css">
</head>

<body>
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
                      <li><a class="list-item" href="addaccount.php">Add &nbsp;Account</a></li>
                      <li><a class="list-item" onclick="return confirm('Are you sure to logout?');" href="logout.php">
                              Logout</a></li>
                  </ul>
              </div>
          </div>

        </nav>

        <div class="pcon"></div>
        <div class="pcon1"></div>

	<div class="container">
		<h1>Add Account</h1>
		<div class="container-box">
		<form class="add" method="POST" action="" enctype="multipart/form-data">
			<?php if (isset($error)): ?>
			<p class="error"><?php echo $error ?></p>
			<?php endif; ?>

                    <div class="right-side">
                        <div class="admin-header">  
                            <h3>ADMIN INFORMATION</h3>
                        </div>
                        <div class="admininfo">
                            <div class="userid-box">
			<label for="adminID">Admin ID: </label>
			<input type="text" name="adminID" required>
			</div>
			
			<div class="name">
			<label for="fullname">Name: </label>
			<input type="text" name="fullname" required>
			</div>

			<div class="position">
			<label for="category">Position: </label>
			<input type="text" name="category" required>
			</div>

			<div class="status">
			<label for="status">Status: </label>
			<input type="text" name="status" required>
			</div>

			<div class="contactnum">
			<label for="contactnum">Contact Number</label>
			<input type="text" name="contactnum" required>
			</div>

			<div class="email">
			<label for="email">Email</label>
			<input type="email" name="email" required>
			</div>

				<div class="password">
				<label for="password">Password</label>
			<input type="password" name="password" required>
			</div>

            <div class="left-side">
            <div class="admin-profile">
    
                            <h4>ADMIN PROFILE</h4>
                        </div>
                        <div class="adminprof">
			<label for="photo">Photo</label>
			<img id="mypreview" alt="Preview Image" style="width: 100px; height: 100px;"> </br></br>
			<input type="file" name="myImage" accept="image/*" onchange="previewImage1(event)" > </br></br>
			</div>

			<input type="submit" value="Add Account">
           
	       </div>
        </form>

	<script>
		function previewImage1(event) {
			var reader = new FileReader();
			reader.onload = function(){
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

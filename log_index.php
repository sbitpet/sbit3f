<?php
require('../connection.php');
session_start();
if (isset($_SESSION['admin'])) {
    header('location: homepage.php');
}
?>


<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>RFG ELITE | Sign in</title>
    <link rel="stylesheet" href="log_In.css" media="screen">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i">
</head>

<body class="u-body u-xl-mode" data-lang="en">
    <section class="Anton Antonio C1C1C1 D9D9D9 EFF Ellipse FFFFFF Lato Rectangle absolute admin align-items background border border-box border-radius box box-shadow box-sizing calc50 center color copyright display enter-email flex font-family font-size font-style font-weight height identical left line-height normal password position px px2 rfg rgba0 rgba70 show-pass sign-in solid text-align to top u-clearfix u-custom-color-4 width u-section-1" id="sec-5ff7">

        <div class="background-img">
            <img class="u-expanded-height u-image u-image-contain u-image-1" src="images/gym2.png" data-image-width="672" data-image-height="371">
        </div>
        
        <div class="parent-box">
            <div class="box-form ">
                <div class="box-form-head">
                    <img class="logo-img" src="images/logo-modified.png" alt="" data-image-width="362" data-image-height="362">
                    <h1>RFG​ ELITE</h1>
                    <p>ADMIN CON​SOLE</p>
                </div>
                <form action="login.php" method="POST" style=" padding: 50px;" name="form" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBkjv5SmWMbXDry4p-t7EAcC8kWKt-tHlDRiQqPn3dmA&s">

                    <div class="u-form-group u-form-name u-label-none ">
                        <input type="text" placeholder="AdminID" id="name-6797" name="adminID" class="u-input u-input-rectangle u-text-black" required>
                    </div>
                    <div class="u-form-group u-form-name u-label-none">
                        <input type="password" placeholder="Password" id="name-623a" name="password" class="u-input u-input-rectangle u-text-black" required>
                    </div>
                    <div class="u-form-checkbox u-form-group u-label-none">
                        <label class="label-showpass u-custom-font u-field-label u-font-lato u-text-body-alt-color" >
                            <input type="checkbox" onclick="Toggle()" class=" u-border-2 u-border-white border-radius-10 u
                                u-field-input u-hover-grey-40">&nbsp;&nbsp;Show Password</label>
                    </div>

                    <button class="button-sign u-border-none u-btn u-btn-round u-btn-submit u-button-style u-custom-color-3
                            u-custom-font u-font-lato u-radius-3 u-btn-1" type="submit" name="form">SIGN
                        IN</button>
                        <?php if (isset($_SESSION['error'])) { ?>
                            <h6> <?= $_SESSION['error'] ?>  </h6> 
                        <?php }?>
                    <input type="hidden" value="" name="recaptchaResponse">
                    <input type="hidden" name="formServices" value="52515aac4bc14354a49765f7416a1252">
                </form>
            </div>



            <div class="footer">
                <p> © Copyright 2023, RFG Elite - Rod’s
                    Fitness Gym<br>All Rights Reserved.
                </p>
            </div>
        </div>
    </section>
    <script>
        // Change the type of input to password or text
        function Toggle() {
            var temp = document.getElementById("name-623a");
            if (temp.type === "password") {
                temp.type = "text";
            } else {
                temp.type = "password";
            }
        }
    </script>
</body>

</html>
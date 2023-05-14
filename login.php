<?php
require ('../connection.php');
session_start();

if(isset($_POST['form'])){
    $adminID = $_POST['adminID'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE adminID = '$adminID'";
    $query = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query) < 1){
        $_SESSION['error'] = '<span style="color: red;">Cannot find account with the User ID</span>';
        header('location: log_index.php');
        return;
    }

    else{
        $row = mysqli_fetch_assoc($query);
        if($password === $row['password']){
            $_SESSION['admin'] = $row['id'];
            $_SESSION['category'] = $row['category'];
        }
        else{
            $_SESSION['error'] = 'Incorrect password';
            header('location: log_index.php');
            return;
        }
    }
}
else{
    $_SESSION['error'] = 'Input admin credentials first';
    header('location: log_index.php');
    return;
}

header('location: homepage.php');
?>
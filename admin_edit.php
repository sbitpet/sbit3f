<?php
require('../connection.php');

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$adminId = $_POST['adminId'];
		$fullname = $_POST['fullname'];
		$photo = $_POST['photo'];
		$password = $_POST['password'];
		$category = $_POST['category'];
		$status = $_POST['status'];
		$contactnum = $_POST['contactnum'];
		$email = $_POST['email'];
		

		$sql = "SELECT * FROM admin WHERE id = $adminId";
		$query = $conn->query($sql);
		$edit = $query->fetch_assoc();

		if($password == $edit['password']){
			$password = $edit['password'];
		}
		else{
			$password = password_hash($password, PASSWORD_DEFAULT);
		}

		$sql = "UPDATE admin SET adminId = '$adminId', fullname = '$fullname', category = '$category', password = '$password', email = '$email', status = '$status', contactnum = '$contactnum', photo = '$photo',  WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Admin Updated Successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location: editProfile.php');

?>
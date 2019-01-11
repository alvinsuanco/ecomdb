<?php 
	require './connect.php';



	$username = $_POST['username'];
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$address = $_POST['address'];


	// retrieve only the data under the username column that
	// has the same value as the username variable
	$sql = "SELECT * FROM users WHERE username = '$username' ";
	$result = mysqli_query($conn, $sql);
	

	if(mysqli_num_rows($result) > 0 ){
		die("user_exists");
	} else {
			$sql_insert = "INSERT INTO users(firstname, lastname, username, password, email, address) VALUES ('$firstname', '$lastname', '$username', '$password', '$email', '$address')";
			$result = mysqli_query($conn, $sql_insert);
	}

?>


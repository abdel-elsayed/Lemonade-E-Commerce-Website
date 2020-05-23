<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	require("config.php");

	function test_input($data) { // check for xss attacks using html
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	  $first = test_input($_POST["firstname"]);
	  $last = test_input($_POST["lastname"]);
	  $username = test_input($_POST["username"]);
	  $email = test_input($_POST["email"]);
	  $phone= test_input($_POST["phone"]);
	  $password = test_input($_POST["password"]);
	  $conpassword = test_input($_POST["cpassword"]);

	 //checking for different errors
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)&&!preg_match("/^[a-zA-Z0-9]*$/", $username)){
		header("Location:signUpIndex.php?error=InvalidEmailAndUsername&firstname=".$firstname."&lastname=".$lastname);
		exit();
	}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		header("Location:signUpIndex.php?error=InvalidEmail&firstname=".$firstname."&lastname=".$lastname."username=".$username);
		exit();
	}elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username))
	{
		header("Location:signUpIndex.php?error=InvalidUserName&firstname=".$firstname."&lastname=".$lastname."email=".$email);
		exit();
	}elseif ($password != $conpassword)
	{
		header("Location:signUpIndex.php?error=PasswordsDontMatch&firstname=".$firstname."&lastname=".$lastname."&username=".$username. "&email=".$email);
		exit();
	}elseif (!preg_match("/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/", $password))
	{
		header("Location:signUpIndex.php?error=PasswordNotSecure&firstname=".$firstname."&lastname=".$lastname."&username=".$username. "&email=".$email);
		exit();
	}else {
		$stmt = $conn->prepare("SELECT username, email FROM users WHERE username=? OR email=? LIMIT 1"); //To check if the username or email already exists
		$stmt->bind_param('ss', $username, $email);
		$stmt->execute();
		$stmt->bind_result($username, $email);
		$stmt->store_result();
		if($stmt->num_rows>0)
			{
				header("Location:signUpIndex.php?error=usernameTaken");
				exit();
			}
		else { // to insert into the database using prepared statements
		$stmt = $conn->prepare("INSERT INTO users(first_name, last_name,phone, username ,email,password) VALUES(?,?,?,?,?,?)");
		$stmt->bind_param('ssssss',$first,$last,$phone,$username,$email,$password);
		$stmt->execute();
			$_SESSION['firstname'] = $first; // setting the session variables
			$_SESSION['lastname'] = $last;
			$_SESSION['email'] = $email;
			$_SESSION['phone'] = $phone;
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			$_SESSION['source'] = "signUp";
			$sql = "SELECT user_id FROM users WHERE username = '" .  $username . "'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result);
			$_SESSION['userId']= $row['user_id'];
			header("Location:profile.php");
			exit();
		}
	}
}
else {
	header("Location:loginIndex.php?error=LoginFirst");
	exit();
}

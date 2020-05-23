<?php
require("config.php"); // databse connection
if(!isset($_GET['subject']))
{
	header("Location:loginIndex.php?error=loginFirst");
	exit();
}

?>
<html>
<head>
		<title> User Update</title >
		<link rel="stylesheet" type= "text/css" href="/project/css/style4.css">
</head>
<body>
	<div class="navBar">
		<h1>
			<a href="bags.php" class="Lemonade">Lemonade <img class="lemon" src="/project/images/lemon.png"></a>
		</h1>
	</div>
	<div class ="card">
		<img src="/project/images/userIcon.png" alt="user Icon" style="width:40%">
			<h1> Update Information </h1>
		<?php if(isset($_GET['error'])){   // to display errors
			  if($_GET['error'] == "InvalidEmailAndUsername" ){
					echo '<p> Invalid Email and Username</p>';
				}elseif($_GET['error'] == "InvalidEmail" ){
					echo '<p> Invalid Email</p>';
				}elseif($_GET['error'] == "InvalidUserName" ){
					echo '<p> Invalid Username</p>';
				}elseif($_GET['error'] == "PasswordsDontMatch" ){
					echo '<p> Passwords Dont Match </p>';
				}elseif($_GET['error'] == "usernameTaken" ){
					echo '<p> Username Already Exists</p>';
				}elseif($_GET['error'] == "emailExists" ){
					echo '<p> Email Already Exists </p>';
				}elseif($_GET['error'] == "PasswordNotSecure" ){
					echo '<p> Password is not secured enough!!! </p>';
				}

			} ?>
			<form action="" method = "POST">
				<?php  if($_GET['subject']=="name") { ?>

				<input type = "text" name ="firstname" placeholder="<?php echo $_SESSION['firstname']?>" class ="inputBox" required>
				<input type = "text" name ="lastname" placeholder="<?php echo $_SESSION['lastname']?>" class ="inputBox" required>

				<?php }  elseif($_GET['subject']=="username") { ?>
				<input type = "text" name ="username" placeholder="<?php echo $_SESSION['username']?>" class ="inputBox">
				<?php }  elseif($_GET['subject']=="email") { ?>
				<input type = "text" name ="email" placeholder="<?php echo $_SESSION['email']?>" class ="inputBox">
				<?php }  elseif($_GET['subject']=="phone") { ?>
				<input type="tel"  name="phone" placeholder="<?php echo $_SESSION['phone']?>" class ="inputBox" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
				<?php }  elseif($_GET['subject']=="password") { ?>
				<input type = "password" name ="password" placeholder="Password" class ="inputBox">
				<input type="password" name ="cpassword" placeholder="Confirm Password" class ="inputBox"  required>
				<div class="pswrdText">
					Requirements:<br>
					-a minimum of 8 characters<br>
					-at least one uppercase letter<br>
					-at least one number (digit)<br>
					-at least one of the following special characters !@#$%^&*-
				</div>
				<?php } ?>
				<button type ="submit" name= "update" class="button">Confrim Update </button>
				<hr>
			</form>

			<form action="/project/php/profile.php" method = "POST">
				<button type ="submit" name ="cancel" class="button"> Cancel </button>
			</form>
	</div>
</body>
</html>
<?php  // form processing
if (isset($_POST['update']))
{
	function trim_input($data) { //to trim the input of any html code
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}


	if ($_GET["subject"]=="name") // update name
	{
		$first=trim_input($_POST["firstname"]);
		$last=trim_input($_POST["lastname"]);
		$sql = "UPDATE users SET first_name=?,last_name=? WHERE user_id= ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('ssi',$first,$last,$_SESSION["userId"]);
		$stmt->execute();
		$_SESSION['source']=="update";
		header("Location:profile.php?update=success");
		exit();
	}

	if ($_GET["subject"]=="username") // update username
	{	$username=trim_input($_POST["username"]);
		$stmt = $conn->prepare("SELECT username FROM users WHERE username=? LIMIT 1");
		$stmt->bind_param('s', $username);
		$stmt->execute();
		$stmt->bind_result($username);
		$stmt->store_result();
		if($stmt->num_rows>0){   // check if username exists

			header("Location:update_profile.php?error=usernameTaken&subject=username");
			exit();
		}

		$sql = "UPDATE users SET username=? WHERE user_id= ? ";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('si',$username,$_SESSION["userId"]);
		$stmt->execute();
		$_SESSION['source']=="update";
		header("Location:profile.php?update=success");
		exit();
	}

	if ($_GET["subject"]=="phone") // update phone number
	{
		$phone=trim_input($_POST["phone"]);
		$sql = "UPDATE users SET phone=? WHERE user_id= ? ";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('si',$phone,$_SESSION["userId"]);
		$stmt->execute();
		$_SESSION['source']=="update";
		header("Location:profile.php?update=success");
		exit();
	}

	if ($_GET["subject"]=="email") //update email
	{
		$email=trim_input($_POST["email"]);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ // to check for a valid email
			header("Location:update_profile.php?error=InvalidEmail&subject=email");
			exit();
		}else{
		$sql = "UPDATE users SET email=? WHERE user_id= ? ";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('si',$email,$_SESSION["userId"]);
		$stmt->execute();
		$_SESSION['source']=="update";
		header("Location:profile.php?update=success");
		exit();
		}
	}

	if ($_GET["subject"]=="password") //update password
	{
		if ($_POST["password"] != $_POST["cpassword"]){ //confirm password
				header("Location:update_profile.php?error=PasswordsDontMatch&subject=password"); // check for errors
		}
		if (!preg_match("/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/", $_POST["password"]))
		{
			header("Location:update_profile.php?error=PasswordNotSecure&subject=password");
			exit();
		}else{
			$password=trim_input($_POST["password"]);
			$sql = "UPDATE users SET password=? WHERE user_id= ? ";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('si',$password,$_SESSION["userId"]);
			$stmt->execute();
			$_SESSION['source']=="update";
			header("Location:profile.php?update=success");
			exit();
		}
	}


 }

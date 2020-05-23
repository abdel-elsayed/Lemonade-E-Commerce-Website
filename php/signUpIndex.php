<?php
session_start();
if(isset($_SESSION['source']))
{
	header("Location:profile.php?AlreadLoggedIn");
	exit();
}
?>
<html>
<head>

		<title> User registration</title >
		<link rel="stylesheet" type= "text/css" href="/project/css/style3.css">
</head>
<body>
	<div class="header">
		<h1>
		<a href="FrontPage.php" class="Lemonade">Lemonade <img class="lemon" src="/project/images/lemon.png"></a>
		</h1>
	</div>

	<div class ="signUpForm">
		<img src="/project/images/userIcon.png" class="userImg">
		<h1> Sign Up Now </h1>
		<form action="/project/php/signUp.php" method = "post">
				<input type = "text" name ="firstname" placeholder="Firstname" class ="inputBox"  required>
				<br>
				<input type = "text" name ="lastname" placeholder="Lastname" class ="inputBox" required>
				<br>
				<input type="tel"  name="phone" placeholder="phone ###-###-####" class ="inputBox" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
				<br>
				<input type = "text" name ="username" placeholder="Username" class ="inputBox" required>
				<br>
				<input type = "text" name ="email" placeholder="Email" class ="inputBox"  required>
				<br>
				<input type = "password" name ="password" placeholder="Password" class ="inputBox"  required>
				<br>
				<div class="pswrdText">
					Requirements:<br>
					-a minimum of 8 characters<br>
					-at least one uppercase letter<br>
					-at least one number (digit)<br>
					-at least one of the following special characters !@#$%^&*-
				</div>
				<br>
				<input type="password" name ="cpassword" placeholder="Confirm Password" class ="inputBox"  required>
				<br>
				<p><span><input type="checkbox"required></span> I agree to the terms of service </P>
				<div class="error">
				<?php
					if(isset($_GET['error'])){
					if($_GET['error'] == "InvalidEmailAndUsername" ){
						echo '<p> Invalid Email and Username</p>';
					}elseif($_GET['error'] == "InvalidEmail" ){
						echo '<p> Invalid Email</p>';
					}elseif($_GET['error'] == "InvalidUserName" ){
						echo '<p> Invalid Username</p>';
					}elseif($_GET['error'] == "PasswordsDontMatch" ){
						echo '<p> Passwords Dont Match </p>';
					}elseif($_GET['error'] == "usernameTaken" ){
						echo '<p> Username or Email Already exists </p>';
					}elseif($_GET['error'] == "emailExists" ){
						echo '<p> Email Already Exists </p>';
					}elseif($_GET['error'] == "PasswordNotSecure" ){
						echo '<p> Password is not secure enough </p>';
					}
				}
				?>
				</div>
				<button type ="submit" class="signUp_button"> Register </button>
				<hr>
				<p class="or"> OR </p>
				<p>Have an account? <a href="loginIndex.php">Log In Now </a></P>
		</form>

	</div>

</body>
</html>

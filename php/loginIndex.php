<?php
session_start();
if(isset($_SESSION['source']))
{
	header("Location:profile.php?AlreadyLoggedIn");
	exit();
}
?>
<html>
<head>
  
		<title> User Login</title >
		<link rel="stylesheet" type= "text/css" href="/project/css/style3.css">
 
</head>
<body>
	<div class="header">
		<h1>
			<a href="FrontPage.php" class="Lemonade">Lemonade <img class="lemon" src="/project/images/lemon.png"></a>
		</h1>
	</div>
	<div class ="logInForm">
		<img src="/project/images/userIcon.png" class="userImg">
		<h1> Login Here </h1>
		<form action="/project/php/login.php" method = "post">
			<input type = "text" name ="username" placeholder="Username" class ="inputBox" required>
			<input type = "password" name ="password" placeholder="Password" class ="inputBox" required>
			<button type ="submit" class="signUp_button"> Login </button>
			<hr>
			<p class="or"> OR </p>
			<p>First time user? <a href="signUpIndex.php">Sign Up now </a></P>
			<div class="error">
			<?php
			if(isset($_GET['error'])){
				if($_GET['error'] == "invalidCredentials" ){
					echo "INVALID CREDENTIALS!";
				}
			}?>
			</div>
		</form>
	
	</div>
	
</body>
</html>   